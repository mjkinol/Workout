<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class ProfileController extends Controller
{
    public function index(){
    	// get all of the workout data
    	$workouts = DB::table('workouts')->get();
        $myWorkouts = DB::table('myworkouts')->where('user', '=', Auth::user()->id)->pluck("created_workout")->toArray();
        $favWorkouts = DB::table('fav_workouts')->where('user', '=', Auth::user()->id)->pluck("workout")->toArray();

        // get following data
        $users = DB::table('users')->get();
		$subscribers = DB::table('subscribe')->where('subscribedTo', '=', Auth::user()->id)->pluck("user")->toArray();
		$following = DB::table('subscribe')->where('user', '=', Auth::user()->id)->pluck("subscribedTo")->toArray(); 

		return view('profile.index', [
            'workouts' => $workouts,
            'favWorkouts' => $favWorkouts,
            'myWorkouts' => $myWorkouts,
            'users' => $users,
            'subscribers' => $subscribers,
            'following' => $following
        ]);
    }

    public function user_profile($id){
    	// get all of the workout data
    	$workouts = DB::table('workouts')->get();
        $myWorkouts = DB::table('myworkouts')->where('user', '=', $id)->pluck("created_workout")->toArray();
        $favWorkouts = DB::table('fav_workouts')->where('user', '=', $id)->pluck("workout")->toArray();

        // get following data
        $main_user = DB::table('users')->where('id', '=', $id)->first();
        $users = DB::table('users')->get();
		$subscribers = DB::table('subscribe')->where('subscribedTo', '=', $id)->pluck("user")->toArray();
		$following = DB::table('subscribe')->where('user', '=', $id)->pluck("subscribedTo")->toArray(); 

		return view('profile.user_profile', [
            'workouts' => $workouts,
            'favWorkouts' => $favWorkouts,
            'myWorkouts' => $myWorkouts,
            'users' => $users,
            'main_user' => $main_user,
            'subscribers' => $subscribers,
            'following' => $following
        ]);
    }
}
