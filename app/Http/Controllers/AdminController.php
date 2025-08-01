<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Dashboard/Dashboard');
    }

    public function shows()
    {
        return Inertia::render('Dashboard/Shows');
    }

    public function bookings()
    {
        return Inertia::render('Dashboard/Booking');
    }

    public function venues()
    {
        return Inertia::render('Dashboard/Venues');
    }

    public function users()
    {
        return Inertia::render('Dashboard/Users');
    }

    public function analytics()
    {
        return Inertia::render('Dashboard/Analytics');
    }

    public function settings()
    {
        return Inertia::render('Dashboard/Settings');
    }
}
