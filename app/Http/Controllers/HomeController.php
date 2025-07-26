<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Home');
    }

    public function about()
    {
        return Inertia::render('About');
    }

    public function show()
    {
        return Inertia::render('Show');
    }

    public function venue()
    {
        return Inertia::render('Venue');
    }

    public function contact()
    {
        return Inertia::render('Contact');
    }

    public function showDetail()
    {
        return Inertia::render('ShowDetails');
    }
}
