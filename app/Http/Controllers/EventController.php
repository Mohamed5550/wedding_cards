<?php

namespace App\Http\Controllers;

use App\Models\Event;
use ArPHP\I18N\Arabic;
use App\Models\WeddingCard;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use App\Http\Resources\EventResource;
use App\Http\Requests\Event\CreateEventRequest;

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
        $event = Event::create($request->all());
        $event->createCustomWeddingCard();

        return "<img src='{$event->customWeddingCard->toJpeg()->toDataUri()}' />";
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