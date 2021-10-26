<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\Activity;
use App\Models\Category;

class DailyChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $challenges= $this->sortData($request);
        $categories = Category::all();
        
        return Inertia::render('DailyChallenges', ["challenges" => $challenges, "categories" => $categories]);
    }
    
    /**
     * Sort data in Collection.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function sortData(Request $request){
        switch ($request->sort) {
            case 'asc':
                return Activity::with(["category"])->where('is_challenge', '1')->when($request->term, function ($query, $term) {
                    $query->where('description', 'LIKE', '%' . $term . '%');
                })->withCount('user_activities')->orderBy('date')->paginate(5);        
                break;
            case 'top':
                return Activity::with(["category"])->where('is_challenge', '1')->when($request->term, function ($query, $term) {
                    $query->where('description', 'LIKE', '%' . $term . '%');
                })->withCount('user_activities')->orderByDesc('user_activities_count')->paginate(5);        
                break;
            default:
                return Activity::with(["category"])->where('is_challenge', '1')->when($request->term, function ($query, $term) {
                    $query->where('description', 'LIKE', '%' . $term . '%');
                })->withCount('user_activities')->orderByDesc('date')->paginate(5);        
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
        $categories = Category::all();
        return Inertia::render('AddChallenge', ["activity" => null, "categories" => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
            'date' => 'required|unique:activities'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $activity = new Activity;
        $activity->name = $request->name;
        $activity->description = $request->description;
        $activity->date = $request->date;
        $activity->category_id = $request->category_id;
        $activity->is_challenge = '1';
        $image  = $request->file("avatar");
        if ($image !== null) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            $path = '/storage/images/' . $imageName;
            $activity->photo = $path;
        } else {
            $activity->photo = '//eu.ui-avatars.com/api/?name=' . $request->name;
        }
        $activity->save();
        return redirect()->back();
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
        $challenges = Activity::find($id);
        $challenges->load("category");
        $categories = Category::all();
        //dd($challenges);
        return Inertia::render('AddChallenge', ["activity" => $challenges, "categories" => $categories]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $activity = Activity::find($id);
        $activity->name = $request->name;
        $activity->description = $request->description;
        $activity->category_id = $request->category_id;
        $image  = $request->file("avatar");
        // if ($image !== null) {
        //     $imageName = time() . '_' . $image->getClientOriginalName();
        //     $image->storeAs('public/images', $imageName);
        //     $path = '/storage/images/' . $imageName;
        //     $activity->photo = $path;
        // }
        // else if($request->removed) {
        //     $activity->photo = null;
        // }
        if ($request->avatar) {
            $activity->photo = $request->avatar;
        } else {
            $activity->photo = '//eu.ui-avatars.com/api/?name=' . $request->name;
        };
        $activity->save();
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
        $challenge = Activity::find($id);
        $challenge->delete();
        return redirect()->back();
    }
}
