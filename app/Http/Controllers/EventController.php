<?php

namespace App\Http\Controllers;

use App\Models\Event;
use ArPHP\I18N\Arabic;
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
