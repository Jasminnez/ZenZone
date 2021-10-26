<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $this->sortData($request);
        return Inertia::render('Categories', ["categories" => $categories]);
    }
    /**
     * Sort data in Collection.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function sortData(Request $request){
        switch ($request->sort) {
            case 'asc':
                return Category::when($request->term, function($query,$term) {
                    $query->where('name', 'LIKE', '%'.$term.'%');
                })->withCount('activities')->orderBy('created_at')->paginate(5);        
                break;
            case 'top':
                return Category::when($request->term, function($query,$term) {
                    $query->where('name', 'LIKE', '%'.$term.'%');
                })->withCount('activities')->orderByDesc('activities_count')->paginate(5);        
                break;
            default:
                return Category::when($request->term, function($query,$term) {
                    $query->where('name', 'LIKE', '%'.$term.'%');
                    })->withCount('activities')->orderByDesc('created_at')->paginate(5);        
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
        ]);
        if ($validator->fails()) {
            //dd($validator);
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $category = new Category;
        $category->name = $request->name;
        $image  = $request->file("avatar");
        if ($image !== null) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            $path = '/storage/images/' . $imageName;
            $category->icon = $path;
        }
        else {
            $category->icon = '//eu.ui-avatars.com/api/?name=' . $request->name;
        }
        $category->save();
        return redirect()->back()
                    ->with('message', 'Category Created Successfully.');
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            //dd($validator);
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        //dd($request);
        $category = Category::find($id);
        $category->name = $request->name;
        if($request->avatar){
            $category->icon = $request->avatar;
        }
        else{
            $category->icon = 'https://eu.ui-avatars.com/api/?name=' . $request->name;
        };
        $category->save();
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
        $category = Category::find($id);
        $category->delete();
        return redirect()->back();
    }
}
