<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class UploadImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadBase64 (Request $request) {
        $base64File = $request->file;
        $file = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));
        $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();
        file_put_contents($tmpFilePath, $file);
        $tmpFile = new File($tmpFilePath);
        $image = new UploadedFile(
            $tmpFile->getPathname(),
            $tmpFile->getFilename(),
            $tmpFile->getMimeType(),
            0,
            true
        );
        $path = $image->store('public/images');
        $pathArr = explode('/', $path);
        $pathToFile = $pathArr[1];
            $user = User::find(Auth::user()->id);
            if($user == null || $user == '')
                return response()->json('User not found.', Response::HTTP_OK);
            $photoPath = '/'.$pathArr[1] . '/' . $pathArr[2];
            $user->profile_photo_path = $photoPath;
            $user->save();           
            return response()->json($photoPath, Response::HTTP_OK);
        //return response()->json($pathToFile, 200);
    }

    public function store(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $image  = $request->file("file");
        if ($image !== null) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            $path = '/images/' . $imageName;
        }
        $user->profile_photo_path = $path;
        $user->save();
        return response()->json(['path' => $user->profile_photo_url]);
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
}
