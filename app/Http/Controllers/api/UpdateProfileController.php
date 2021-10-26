<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Resources\UsersResource;

class UpdateProfileController extends Controller
{
    //
    public function ProfileUpdate(Request $request){

        $user = User::find(Auth::user()->id);
        $user->update($request->all());
        return [
            'message' => 'Updated'
        ];;
    }
}
