<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\UserActivity;
use App\Models\User;
use App\Models\Activity;


class UserActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('user')) {
            $user_activities = UserActivity::with(["user", "activity.category"])->when($request->user, function ($query, $user) {
                $query
                    ->where('user_id', $user);
            })->withCount('likes', 'comments')->paginate(6);
        } else {
            $user_activities = $this->sortData($request);
        }
        $users = User::all();
        $activities = Activity::all();
        
        return Inertia::render('UserActivities', ["user_activities" => $user_activities, "users" => $users, "activities" => $activities]);
    }
    /**
     * Sort data in Collection.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function sortData(Request $request){
        switch ($request->sort) {
            case 'asc':
                return UserActivity::with(["user", "activity.category"])->when($request->term, function ($query, $term) {
                    $query->where('description', 'LIKE', '%' . $term . '%');
                })->withCount('likes', 'comments')->orderBy('created_at')->paginate(6); 
                break;
            case 'top':
                return UserActivity::with(["user", "activity.category"])->when($request->term, function ($query, $term) {
                    $query->where('description', 'LIKE', '%' . $term . '%');
                })->withCount('likes', 'comments')->orderByDesc('likes_count')->paginate(6);        
                break;
            default:
                return UserActivity::with(["user", "activity.category"])->when($request->term, function ($query, $term) {
                    $query->where('description', 'LIKE', '%' . $term . '%');
                })->withCount('likes', 'comments')->orderByDesc('created_at')->paginate(6);        
                break;
            }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $user_activity = UserActivity::find($id);
        $user_activity->user_id = $request->user_id;
        $user_activity->activity_id = $request->activity_id;
        $user_activity->description = $request->description;
        $image  = $request->file("avatar");
        if ($image !== null) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            $path = '/storage/images/' . $imageName;
            $user_activity->photo = $path;
        } else {
            $user_activity->photo = null;
        }
        $user_activity->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_activity = UserActivity::find($id);
        $user_activity->delete();
        return redirect()->back();
    }
}
