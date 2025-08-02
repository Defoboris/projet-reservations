<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowRequest;
use App\Models\Locality;
use App\Models\Show;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Dashboard/Dashboard');
    }


    public function shows()
    {
        $shows = Show::with('locality')->get();
        $localities = Locality::all();
        
        return Inertia::render('Dashboard/Shows', [
            'shows' => $shows,
            'localities' => $localities
        ]);
    }

    /**
     * Handles the creation of a show.
     *
     * @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function createShow(ShowRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);

        Show::create($data);

        return redirect()->back()->with('success', 'Show created!');
    }

    /**
     * Handles the update of a show.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function updateShow(ShowRequest $request, Show $show)
    {
        $data = $request->validated();

        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);

        $show->update($data);

        return redirect()->back()->with('success', 'Show updated!');
    }

    public function destroyShow(Show $show)
    {
        $show->delete();
        return redirect()->back()->with('success', 'Show deleted!');
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
