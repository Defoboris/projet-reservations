<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Price;
use App\Models\Representation;
use App\Models\Show;
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
        $allShows = Show::where('bookable', true)->with('locality')->get();

        return Inertia::render('WebSite/Show', [
            'allShows' => $allShows
        ]);
    }

    public function venue()
    {
        $venues = Location::with('locality')->get();

        return Inertia::render('WebSite/Venue', [
            'venues' => $venues
        ]);
    }

    public function contact()
    {
        return Inertia::render('WebSite/Contact');
    }

    public function showDetail(Show $show)
    {
        $show = Show::where('id', $show->id)->with('locality')->first();
        $mockRepresentations = Representation::where('show_id', $show->id)->with('location')->get();
        $prices = Price::all();
        return Inertia::render('WebSite/ShowDetails', [
            'show' => $show,
            'mockRepresentations' => $mockRepresentations,
            'prices' => $prices
        ]);
    }
}
