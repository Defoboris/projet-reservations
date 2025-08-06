<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowRequest;
use App\Models\Locality;
use App\Models\Location;
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

    /**
     * Deletes a show.
     *
     * Removes the show with the given id from the database
     * and redirects the user back to the shows management page with a success message.
     *
     * @param  \App\Models\Show  $show
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyShow(Show $show)
    {
        $show->delete();
        return redirect()->back()->with('success', 'Show deleted!');
    }

    public function representations()
    {
        return Inertia::render('Dashboard/Representations');
    }


    public function bookings()
    {
        return Inertia::render('Dashboard/Booking');
    }

    /**
     * Displays the venues management dashboard.
     *
     * Retrieves all localities from the database and passes them to the
     * Inertia view for rendering the venues management page.
     *
     * @return \Inertia\Response
     */

    public function venues()
    {
        $venues = Location::with('locality')->get();
        $localities = Locality::all();

        return Inertia::render('Dashboard/Venues', [
            'venues' => $venues,
            'localities' => $localities
        ]);
    }


    /**
     * Handles the creation of a venue.
     *
     * Creates a new Locality with the data provided in the request
     * and redirects the user back to the venues management page with a success message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createVenue(Request $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($data['designation']);
        Location::create($data);
        return redirect()->back()->with('success', 'Venue created!');
    }


    /**
     * Handles the update of a venue.
     *
     * Updates the venue with the data provided in the request
     * and redirects the user back to the venues management page with a success message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateVenue(Request $request, Location $venue)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['designation']);
        $venue->update($data);
        return redirect()->back()->with('success', 'Venue updated!');
    }

    /**
     * Deletes a venue.
     *
     * Removes the venue with the given id from the database
     * and redirects the user back to the venues management page with a success message.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyVenue(Location $location)
    {
        $location->delete();
        return redirect()->back()->with('success', 'Venue deleted!');
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
