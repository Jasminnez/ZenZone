<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use App\Models\Activity;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('category')) {
            $activities = Activity::with(["category"])->where('is_challenge', 0)->when($request->category, function ($query, $category) {
                $query->where('category_id', $category);
            })->orderByDesc('date')->paginate(4);
        } else {
            $activities = $this->sortData($request);
        }
        
        $categories = Category::all();
        return Inertia::render('Activities', ["activities" => $activities, "categories" => $categories]);
    }
    /**
     * Sort data in Collection.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function sortData(Request $request){
        switch ($request->sort) {
            case 'asc':
                return Activity::with(["category"])->where('is_challenge', 0)->when($request->term, function ($query, $term) {
                    $query->where('name', 'like', '%' . $term . '%');
                })->withCount('user_activities')->orderBy('date')->paginate(4); 
                break;
            case 'top':
                return Activity::with(["category"])->where('is_challenge', 0)->when($request->term, function ($query, $term) {
                    $query->where('name', 'like', '%' . $term . '%');
                })->withCount('user_activities')->orderByDesc('user_activities_count')->paginate(4);         
                break;
            default:
                return Activity::with(["category"])->where('is_challenge', 0)->when($request->term, function ($query, $term) {
                    $query->where('name', 'like', '%' . $term . '%');
                })->withCount('user_activities')->orderByDesc('date')->paginate(4);        
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
        //dd($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
        ]);
        if ($validator->fails()) {
            //dd($validator);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $activity = new Activity;
        $activity->name = $request->name;
        $activity->description = $request->description;
        $activity->date = now();
        $activity->category_id = $request->category_id;
        $activity->is_challenge = '0';
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
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
        // var_dump( $request->all());
        // die();
        $activity->description = $request->description;
        $activity->category_id = $request->category_id;
        // $image  = $request->file("avatar");
        // if ($image !== null) {
        //     $imageName = time() . '_' . $image->getClientOriginalName();
        //     $image->storeAs('public/images', $imageName);
        //     $path = '/storage/images/' . $imageName;
        //     $activity->photo = $path;
        // } else if ($request->removed) {
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
        $activity = Activity::find($id);
        $activity->delete();
        return redirect()->back();
    }
}
