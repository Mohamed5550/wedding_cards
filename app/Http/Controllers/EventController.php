<?php

namespace App\Http\Controllers;

use App\Models\Event;
use ArPHP\I18N\Arabic;
use App\Enums\EventStatus;
use App\Models\WeddingCard;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use App\Imports\InviteesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\EventResource;
use App\Http\Requests\Event\CreateEventRequest;
use App\Http\Requests\Event\PreviewEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response([
            'events' => EventResource::collection(Event::get())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEventRequest $request)
    {
        $event = auth()->user()->events()->create($request->all());
        
        Excel::import(new InviteesImport($event->id), $request->file('invitees_file'));

        $event->sendInvites();

        return response([
            'message' => __("All invites have been successfully sent")
        ]);
    }

    public function preview(PreviewEventRequest $request)
    {
        $event = Event::make($request->all());
        $event->createCustomWeddingCard();

        return response([
            'message' => __("Event created succesfully"),
            'src' => $event->customWeddingCard->toJpeg()->toDataUri()
        ]);
    }

    public function start(Event $event)
    {
        if($event->status != EventStatus::NOT_STARTED) {
            return response([
                'message' => __("Event already started")
            ], 400);
        }

        $event->status = EventStatus::IN_PROGRESS;
        $event->save();

        return response([
            'message' => __("Event started successfully")
        ]);
    }

    public function end(Event $event)
    {
        if($event->status != EventStatus::IN_PROGRESS) {
            return response([
                'message' => __("Can't end event")
            ], 400);
        }

        $event->status = EventStatus::FINISHED;
        $event->save();


        return response([
            'message' => __("Event ended successfully")
        ]);
    }

    public function attend(Event $event, Request $request)
    {
        $qrCode = $request->qr_code;

        $invitee = $event->invitees()->where('qr_token', $qrCode)->first();

        if(!$invitee) {
            return response([
                'message' => __("Invalid QR code")
            ], 400);
        }

        if($invitee->attended_at) {
            return response([
                'message' => __("This user has already attended")
            ], 400);
        }

        $invitee->attended_at = now();
        $invitee->save();

        return response([
            'message' => __("Invitee marked as attended successfully")
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
