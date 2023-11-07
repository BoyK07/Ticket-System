<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show()
    {
        $events = Event::where('date', '>', now())->orderBy('date')->get();
        return view('home', ['events' => $events]);
    }
}
