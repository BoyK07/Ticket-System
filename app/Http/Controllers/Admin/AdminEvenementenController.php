<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminEvenementenController extends Controller
{
    public function show()
    {
        $events = Event::all();
        return view('admin.events.index')->with(compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required',
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->location = $request->location;
        $event->description = $request->description;
        $event->image = $request->image;
        $event->price = $request->price;
        $event->save();

        return redirect()->route('admin.events.index')->with('succes', 'Evenement aangemaakt');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit')->with(compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required',
        ]);

        $event->title = $request->title;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->location = $request->location;
        $event->description = $request->description;
        $event->image = $request->image;
        $event->price = $request->price;
        $event->save();

        return redirect()->route('admin.events.index')->with('succes', 'Evenement aangepast');
    }

    public function delete(Request $request, Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('succes', 'Evenement verwijderd');
    }
}
