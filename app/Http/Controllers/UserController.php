<?php

namespace App\Http\Controllers;

use App\Mail\PasswordToMail;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with(["role"])->when($request->term, function ($query, $term) {
            $query->where('name', 'LIKE', '%' . $term . '%');
        })->paginate(12);
        
        return Inertia::render('Users', ["users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('UserForm', ["user" => null]);
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
            'email' => 'required',
            'username' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = new User;
        $user->name = $request->fullname;
        $user->email = $request->email;
        $password = str::random(15);
        $user->password = Hash::make($password);
        $details=[
            'title' => 'Credentials',
            'body' => 'E-mail:'. " ".$user->email." ".'Password:'." ".$password
        ];
        Mail::to($request->email)->send(new PasswordToMail($details));
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->role_id = $request->role_id;
        $user->gender = $request->gender_id;
        $image  = $request->file("avatar");
        if ($image !== null) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            $path = '/storage/images/' . $imageName;
            $user->profile_photo_path = $path;
        }

        $user->save();
        return Inertia::render('Users');
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
        $User = User::find($id);
        return Inertia::render('UserForm', ["user" => $User]);
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
            'email' => 'required',
            'username' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $User = User::find($id);
        $User->load("role")->get();
        $User->name = $request->fullname;
        $User->email = $request->email;
        $User->username = $request->username;
        $User->phone = $request->phone;
        $User->role_id = $request->role_id;
        $User->gender = $request->gender_id;
        if ($request->avatar) {
            $User->profile_photo_path = $request->avatar;
        }
        if ($request->removed) {
            //$User->profile_photo_path = 'https://eu.ui-avatars.com/api/?name=' . $request->fullname;
            $User->profile_photo_path = NULL;
        }
        $User->save();
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
        $User = User::find($id);
        $User->delete();
        return redirect()->back();
    }
}
