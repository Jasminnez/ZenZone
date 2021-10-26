<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityCollection;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ActivityCollection(Activity::with(["category"])->where('is_challenge', '0')->get());
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
        return new ActivityResource(Activity::with(["category"])->where('is_challenge', '0')->find($id));
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
        return new ActivityCollection(Activity::with(["category"])
            ->where('name', 'like', '%' . $name . '%')
            ->where('is_challenge', '0')
            ->get());
    }

    /**
     * Search for a category.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function category($category)
    {
        return new ActivityCollection(Activity::with(["category"])
            ->where('category_id', $category)
            ->where('is_challenge', '0')
            ->get());
    }
}
