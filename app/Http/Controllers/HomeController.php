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
        return Inertia::render('WebSite/Home');
    }

    public function about()
    {
        return Inertia::render('WebSite/About');
    }

    public function show()
    {
        return Inertia::render('WebSite/Show');
    }

    public function venue()
    {
        return Inertia::render('WebSite/Venue');
    }

    public function contact()
    {
        return Inertia::render('WebSite/Contact');
    }

    public function showDetail()
    {
        return Inertia::render('WebSite/ShowDetails');
    }
}
