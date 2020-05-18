<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class WorkoutsController extends Controller
{
	public function index(){
		$workouts = DB::table('workouts')->orderBy('likes', 'desc')->get();

		return view('workouts.index', [
			'workouts' => $workouts
		]);
	}

	public function show($id){
		// grab the specific workout
		$workout = DB::table('workouts')->where('id', '=', $id)->first();

		return view('workouts.show', [
			'workout' => $workout
		]);
	}

	public function edit($id){
		$workout = DB::table('workouts')->where('id', '=', $id)->first();

        return view('workouts.edit', [
            'workout' => $workout
        ]);
	}

    public function like($id, Request $request){
        $workout = DB::table('workouts')->where('id', '=', $id)->first();
        $newLikes = $workout->likes + 1;

        DB::table('workouts')
            ->where('id', '=', $id)
            ->update([
                'likes' => $newLikes,
            ]);

        return redirect()->route('workouts');
    }
    public function dislike($id, Request $request){
        $workout = DB::table('workouts')->where('id', '=', $id)->first();
        $newDislikes = $workout->dislikes + 1;

        DB::table('workouts')
            ->where('id', '=', $id)
            ->update([
                'dislikes' => $newDislikes,
            ]);

        return redirect()->route('workouts');
    }

	public function update($id, Request $request){
		$request->validate([
            'name' => 'required|max:30',
            'category' => 'required|max:30',
            'routine' => 'required',
            'description' => 'required'
        ]);

        $oldWorkout = DB::table('workouts')->where('id', '=', $id)->first();

        DB::table('workouts')
            ->where('id', '=', $id)
            ->update([
                'name' => $request->input('name'),
            	'category' => $request->input('category'),
            	'routine' => $request->input('routine'),
            	'description' => $request->input('description')
            ]);

        return redirect()
	        ->route('workout', ['id' => $id])
            ->with(
                'success',
                "'{$oldWorkout->name}' was successfully updated!"
            );
	}

	public function create(){
		return view('workouts.create');
	}

	public function store(Request $request){
		$request->validate([
            'name' => 'required|max:30',
            'category' => 'required|max:30',
            'routine' => 'required',
            'description' => 'required'
        ]);

        $newId = DB::table('workouts')
                ->insertGetId([
                    'name' => $request->input('name'),
                    'creator' => Auth::user()->name,
                	'category' => $request->input('category'),
                	'likes' => 0,
                	'dislikes' => 0,
                	'routine' => $request->input('routine'),
                	'description' => $request->input('description')
                ]);

        DB::table('myworkouts')
            ->insert([
                'user' => Auth::user()->id,
                'created_workout' => $newId
            ]);

        return redirect()
	        ->route('workouts')
            ->with(
                'success',
                "Workout '{$request->input('name')}' was successfully created!"
            );
	}

	public function showDeleteConfirmation($id)
    {
        $workout = DB::table('workouts')->where('id', '=', $id)->first();

        return view('workouts.delete-confirmation', [
            'workout' => $workout
        ]);
    }

    public function delete($id)
    {
    	// FUTURE MAKE SURE TO DELETE THIS FROM RELATED TABLES
        $workout = DB::table('workouts')->where('id', '=', $id)->first();
        DB::table('workouts')->where('id', '=', $id)->delete();

        return redirect()
            ->route('workouts')
            ->with(
                'success',
                "The '{$workout->name}' workout was successfully deleted"
            );
    }

    public function favWorkoutsIndex()
    {
        $workouts = DB::table('workouts')->get();

        $favWorkouts = DB::table('fav_workouts')->where('user', '=', Auth::user()->id)->pluck("workout")->toArray();

        return view('workouts.myFavorites', [
            'workouts' => $workouts,
            'favWorkouts' => $favWorkouts
        ]);
    }

    public function showFavoriteConfirmation($id)
    {
        $workout = DB::table('workouts')->where('id', '=', $id)->first();

        return view('workouts.favorite-confirmation', [
            'workout' => $workout
        ]);
    }

    public function showUnfavoriteConfirmation($id)
    {
        $workout = DB::table('workouts')->where('id', '=', $id)->first();

        return view('workouts.unfavorite-confirmation', [
            'workout' => $workout
        ]);
    }

    public function favorite($id)
    {
        $workout = DB::table('workouts')->where('id', '=', $id)->first();
        
        DB::table('fav_workouts')
            ->insert([
                'user' => Auth::user()->id,
                'workout' => $workout->id,
            ]);

        // redirect to the users page with success message
        return redirect()
        ->route('workout', ['id' => $id])
        ->with(
            'success',
            "You successfully added '{$workout->name}' to your FavWorkouts!"
        );
            
    }

    public function unfavorite($id)
    {
        $workout = DB::table('workouts')->where('id', '=', $id)->first();
        
        $toRemove = DB::table('fav_workouts')
                ->where('user', '=', Auth::user()->id)
                ->where('workout', '=', $workout->id)->first();

        DB::table('fav_workouts')->delete($toRemove->id);

        // redirect to the users page with success message
        return redirect()
        ->route('favWorkouts')
        ->with(
            'success',
            "You removed '{$workout->name}' from your FavWorkouts."
        );
    }

    public function myworkoutsIndex(){
        $workouts = DB::table('workouts')->get();

        $myWorkouts = DB::table('myworkouts')->where('user', '=', Auth::user()->id)->pluck("created_workout")->toArray();

        return view('workouts.myworkouts', [
            'workouts' => $workouts,
            'myWorkouts' => $myWorkouts
        ]);
    }
}
