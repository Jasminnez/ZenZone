<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all()->count();
        $activities = Activity::where('is_challenge', '0')->get()->count();
        $dailyChallenges = Activity::where('is_challenge', '1')->get()->count();
        $males = User::where('gender', 'male')->get()->count();
        $females = User::where('gender', 'female')->get()->count();
        $activitiesByDate = Activity::select('date')->selectRaw('count(*) as count')->orderBy('date', 'desc')->groupBy('date')->take(3)->get();
        $usersByDate = User::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date'))->selectRaw('count(*) as count')->orderBy('date', 'desc')->groupBy('date')->take(3)->get();
        $challengeByDate = DB::table('user_activities')
        ->Join('activities','activities.id','=','user_activities.activity_id')
        ->where('activities.is_challenge','1')
        ->select(DB::raw('DATE_FORMAT(user_activities.created_at, "%Y-%m-%d") as date'))->selectRaw('count(*) as count')
        ->orderBy('date', 'desc')
        ->groupBy(DB::raw('DATE_FORMAT(user_activities.created_at, "%Y-%m-%d")'))
        ->take(3)->get();

        foreach($challengeByDate as $challenge){
            $challengeCount[] = $challenge->count;
            $challengeDate[] = $challenge->date;
        }

        for ($i = 0 ; $i <= 7; $i++) {
         $femaleActivities[] = DB::table('user_activities')
        ->Join('users','users.id','=','user_activities.user_id')
        ->where('users.gender','female')
        ->select(DB::raw('DATE_FORMAT(user_activities.created_at, "%Y-%m-%d") as date'))->selectRaw('count(*) as count')->whereDate('user_activities.created_at', '=', Carbon::now()->subDays($i)->format('Y-m-d'))->groupBy('date')
        ->get();
        $maleActivities[] = DB::table('user_activities')
        ->Join('users','users.id','=','user_activities.user_id')
        ->where('users.gender','male')
        ->select(DB::raw('DATE_FORMAT(user_activities.created_at, "%Y-%m-%d") as date'))->selectRaw('count(*) as count')->whereDate('user_activities.created_at', '=', Carbon::now()->subDays($i)->format('Y-m-d'))->orderBy('date', 'desc')->groupBy('date')
        ->get();
        
        if(!filled($femaleActivities[$i])){
            $array = collect([['date' => Carbon::now()->subDays($i)->format('Y-m-d'), 'count' => 0]]);
            $femaleActivities[$i] = $array;
        }
        else{
            $array = collect([['date' => $femaleActivities[$i][0]->date, 'count' => $femaleActivities[$i][0]->count]]);
            $femaleActivities[$i] = $array;
        }

        if(!filled($maleActivities[$i])){
            $array = collect([['date' => Carbon::now()->subDays($i)->format('Y-m-d'), 'count' => 0]]);
            $maleActivities[$i] = $array;
        }
        else{
            $array = collect([['date' => $maleActivities[$i][0]->date, 'count' => $maleActivities[$i][0]->count]]);
            $maleActivities[$i] = $array;
        }
        }
        foreach($activitiesByDate as $activity){
            $date[] = $activity->date;
            $count[] = $activity->count;
        }
        foreach($usersByDate as $user){
            $userDate[] = $user->date;
            $userCount[] = $user->count;
        }
        foreach($maleActivities as $male){
            $UserActivitesDate[] = $male[0]["date"];
            $maleCount[] = $male[0]["count"];
        }
        foreach($femaleActivities as $female){
            $femaleCount[] = $female[0]["count"];
        }
        return Inertia::render('Dashboard', ["users" => $users, 
        "activities" => $activities,
        "dailyChallenges" => $dailyChallenges,
        "males" => $males, 
        "females" => $females, 
        "date" => $date, 
        "count" => $count, 
        "userDate" => $userDate, 
        "userCount" => $userCount,
        "UserActivitesDate" => $UserActivitesDate, 
        "maleCount" => $maleCount,
        "femaleCount" => $femaleCount,
        "challengeCount" => $challengeCount,
        "challengeDate" => $challengeDate]);

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
