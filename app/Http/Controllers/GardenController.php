<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGardenRequest;
use App\Http\Requests\UpdateGardenRequest;
use App\Models\Garden;
use App\Models\GardenSave;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GardenController extends Controller
{
    /**
     * "New / Continue / Load" screen
     *
     * New shows 'name' => textinput and posts to GardenController@store
     * Load shows list (on frontend, grab full save list and send it to frontend). Loading any of those is GardenSaveController@show
     * Continue redirects to GardenSaveController@show with latest GardenSave
     */
    public function index()
    {
        $gardens = auth()->user()->gardens;
        return Inertia::render('Gardens/Start', ['gardens' => $gardens]);
    }

    /**
     * Store new garden, redirect to show.
     */
    public function store(StoreGardenRequest $request)
    {
        $garden = Garden::create([
            'name' => $request->validated()['name'],
            'user_id' => auth()->id(),
        ]);
        $save = $garden->saves()->create([
            'name' => 'First save',
            'data' => '{}',
        ]);

        return redirect()->route('gardens.show', ['garden' => $garden]);
    }

    public function show(Garden $garden)
    {
        return Inertia::render('Gardens/Play', ['garden' => $garden, 'gardenSave' => $garden->lastSave()]);
    }

    /**
     * Delete entire garden and related saves, redirect to index.
     */
    public function destroy(Garden $garden)
    {
        $garden->delete();
        return redirect()->route('gardens.index');
    }
}
