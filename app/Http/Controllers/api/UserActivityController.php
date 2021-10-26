<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserActivityCollection;
use App\Http\Resources\UserActivityResource;
use App\Models\Activity;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UserActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_activities = UserActivity::with(["user", "activity.category", "likes"])->orderByRaw('created_at DESC')->get();
        if(auth('sanctum')->user() !== null){
            $user = auth('sanctum')->user()->id;
            foreach($user_activities as $user_activity ){
                $likes=$user_activity->likes;
            foreach($likes as $like){
                if($like->user_id === $user)
                   $user_activity->like = true;
                }
            
            if(!filled($user_activity->like)){
                $user_activity->like = false;
            }
        }
        }
        
        return new UserActivityCollection($user_activities);
        //return new UserActivityCollection(UserActivity::with(["user", "activity.category", "likes"])->orderByRaw('created_at DESC')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activity = $this->getActivity($request);
        $path  = $this->imageHandler($request->file("avatar"));

        $user_activity = UserActivity::create([
            'user_id' => Auth::user()->id,
            'activity_id' => $activity->id,
            'description' => $request->description,
        ]);

        if ($path == null) {
            $user_activity->photo = $activity->photo = 'https://eu.ui-avatars.com/api/?name=' . $activity->name;
            $user_activity->is_default_photo = true;
        } else {
            $user_activity->photo = $activity->photo = $path;
            $user_activity->is_default_photo = false;
        }
        $activity->save();
        $user_activity->save();
        return new UserActivityResource($user_activity);
    }
    public function AddUserActivity(Request $request)
    {

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
           
        $photoPath = '/'.$pathArr[1] . '/' . $pathArr[2];
        $activity = $this->getActivity($request);

        $user_activity = UserActivity::create([
            'user_id' => Auth::user()->id,
            'activity_id' => $activity->id,
            'description' => $request->description,
        ]);

        if ($path == null) {
            $user_activity->photo = $activity->photo = 'https://eu.ui-avatars.com/api/?name=' . $activity->name;
            $user_activity->is_default_photo = true;
        } else {
            $user_activity->photo = $activity->photo = 'https://high-voltage-9884-backend.zendev.se/storage'.$photoPath;
            $user_activity->is_default_photo = false;
        }
        $activity->save();
        $user_activity->save();
        return new UserActivityResource($user_activity);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserActivityResource(UserActivity::with(["user", "activity.category"])->find($id));
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
        $user_activity = UserActivity::with(["user", "activity.category"])->find($id);
        if (filled($request->description)) {
            $user_activity->description = $request->description;
        }
        $user_activity->save();
        return new UserActivityResource($user_activity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return UserActivity::destroy($id);
    }

    /**
     * Search based on category.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function category($id)
    {
        $user_activities = UserActivity::with(['user', 'activity.category'])->get();
        return new UserActivityCollection($user_activities->where('activity.category.id', $id));
    }

    /**
     * Search based on user.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function user($id)
    {
        $user_activities = UserActivity::with(['user', 'activity.category'])->get();
        return new UserActivityCollection($user_activities->where('user.id', $id));
    }


    /**
     * Search based on activity name.
     *
     * @param  int  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        $user_activities = UserActivity::with(['user', 'activity.category'])->get();
        return new UserActivityCollection($user_activities->where('activity.name', 'like', $name));
    }

    /**
     * Search for a date.
     *
     * @return \Illuminate\Http\Response
     */
    public function date($date)
    {
        return new UserActivityCollection(UserActivity::with(['user', 'activity.category'])
            ->whereDate('created_at', $date)
            ->get());
    }
    
    /**
     * Display sorted activities.
     *
     * @return \Illuminate\Http\Response
     */
    public function sort($type) 
    {
        switch ($type) {
            case 'asc':
                return new UserActivityCollection(UserActivity::with(['user', 'activity.category'])->orderBy('created_at')->get());
                break;
            case 'desc':
                return new UserActivityCollection(UserActivity::with(['user', 'activity.category'])->orderByDesc('created_at')->get());
                break;
            case 'top':
                return new UserActivityCollection(UserActivity::with(['user', 'activity.category'])->withCount('likes')->orderByDesc('likes_count')->get());
                break;                        
            default:
                return 'Parameter You entered is invalid.';
                break;
        }
    }

    public function imageHandler($image)
    {
        if ($image !== null) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            $path = 'https://high-voltage-9884-backend.zendev.se/storage/images/' . $imageName;
            return $path;
        }
        return null;
    }

    public function getActivity(Request $request)
    {
        return ($request->filled('activity_id') ? $this->predefinedActivity($request) : $this->customizedActivity($request));
    }

    public function customizedActivity(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);
        return Activity::firstOrCreate(
            ['name' => $request->name],
            [
                'description' => $request->description,
                'category_id' => $request->category_id,
                'is_challenge' => '0',
                'date' => now()
            ],
        );
    }

    public function predefinedActivity(Request $request)
    {
        $request->validate([
            'activity_id' => 'required'
        ]);
        $activity = Activity::find($request->activity_id);
        return $activity;
    }
}
