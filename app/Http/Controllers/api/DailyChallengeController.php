<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DailyChallengeCollection;
use App\Http\Resources\DailyChallengeResource;
use App\Models\Activity;
use Illuminate\Http\Request;

class DailyChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new DailyChallengeCollection(Activity::with(["category", "user_activities"])->where('is_challenge', '1')->withCount('user_activities')->orderByDesc('date')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new DailyChallengeResource(Activity::with(["category"])->where('is_challenge', '1')->withCount('user_activities')->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Search for a name.
     *
     * @param  int  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return new DailyChallengeCollection(Activity::with(["category"])
            ->where('name', 'like', '%' . $name . '%')
            ->where('is_challenge', '1')
            ->withCount('user_activities')
            ->get());
    }

    /**
     * Display the specified challenge.
     *
     * @return \Illuminate\Http\Response
     */
    public function date()
    {
        return new DailyChallengeCollection(Activity::with(["category"])
            ->whereDate('date', now())
            ->where('is_challenge', '1')
            ->withCount('user_activities')
            ->get());
    }

    /**
     * Display sorted challenges.
     *
     * @return \Illuminate\Http\Response
     */
    public function sort($type)
    {
        switch ($type) {
            case 'asc':
                return new DailyChallengeCollection(Activity::with(['category'])->orderBy('date')->get());
                break;
            case 'desc':
                return new DailyChallengeCollection(Activity::with(['category'])->orderByDesc('date')->get());
                break;
            case 'top':
                return new DailyChallengeCollection(Activity::with(["category"])
                    ->where('is_challenge', '1')
                    ->withCount('user_activities')
                    ->orderByDesc('user_activities_count')
                    ->get());
                break;                        
            default:
                return 'Parameter You entered is invalid.';
                break;
        }
    }
}
