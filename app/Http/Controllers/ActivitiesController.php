<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ActivitiesController extends Controller
{
	public function index(){
		$activities = DB::table('activities')->orderBy('likes', 'desc')->get();

        return view('activities.index', [
            'activities' => $activities
        ]);
	}

	public function create(){
		return view('activities.create');
	}

	public function store(Request $request){
		$request->validate([
            'name' => 'required|max:30',
            'category' => 'required|max:30'
        ]);

        DB::table('activities')
            ->insert([
                'name' => $request->input('name'),
            	'category' => $request->input('category'),
            	'likes' => 0
            ]);

        return redirect()
	        ->route('activities')
            ->with(
                'success',
                "Activity '{$request->input('name')}' was successfully created!"
            );
	}

	public function discussion($id){
		$activity = DB::table('activities')->where('id', '=', $id)->first();
		return view('activities.discussion', [
			'activity' => $activity
		]);
	}

    public function like($id, Request $request){
        $activity = DB::table('activities')->where('id', '=', $id)->first();
        $newLikes = $activity->likes + 1;

        DB::table('activities')
            ->where('id', '=', $id)
            ->update([
                'likes' => $newLikes,
            ]);
        return redirect()->route('activities');
    }

    public function dislike($id, Request $request){
        $activity = DB::table('activities')->where('id', '=', $id)->first();
        $newDislikes = $activity->dislikes + 1;

        DB::table('activities')
            ->where('id', '=', $id)
            ->update([
                'dislikes' => $newDislikes,
            ]);

        return redirect()->route('activities');
    }
}
