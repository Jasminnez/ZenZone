<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return like::all();
    }


    public function like(Request $request)
    {
        //
        $likes = Like::where('user_id', Auth::user()->id)->where('user_activity_id', $request->user_activity_id)->first();
        if($likes){
            return [
                'message' => 'you already liked it'
            ];
        }
        else{
        $like = Like::create([
            'user_id' => Auth::user()->id,
            'user_activity_id' => $request->user_activity_id,
        ]);
        $like->save();
        return [
            'message' => 'liked'
        ];
    }
    }

    public function unlike(Request $request)
    {
        //
        $like = Like::where('user_activity_id', $request->user_activity_id)->where('user_id', Auth::user()->id)->delete();
        return [
            'message' => 'unliked'
        ];
    }
}
