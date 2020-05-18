<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class UsersController extends Controller
{
	public function index(){
		$users = DB::table('users')->get();

		$alreadySubscribed = DB::table('subscribe')->where('user', '=', Auth::user()->id)->pluck("subscribedTo")->toArray();

		return view('users.index', [
			'users' => $users,
			'authId' => strval(Auth::user()->id),
			'alreadySubscribed' => $alreadySubscribed
		]);
	}

	public function subscribe($id){
		$user = DB::table('users')->where('id', '=', $id)->first();
		
		DB::table('subscribe')
        ->insert([
            'user' => Auth::user()->id,
            'subscribedTo' => $user->id,
        ]);

        // redirect to the users page with success message
        return redirect()
	        ->route('home')
            ->with(
                'success',
                "You successfully subscribed to '{$user->name}'!"
            );
	}

	public function unsubscribe($id){
		$user = DB::table('users')->where('id', '=', $id)->first();

		$toRemove = DB::table('subscribe')
				->where('user', '=', Auth::user()->id)
				->where('subscribedTo', '=', $id)->first();

		DB::table('subscribe')->delete($toRemove->id);

        // redirect to the users page with success message
        return redirect()
	        ->route('home')
            ->with(
                'success',
                "You successfully unsubscribed from '{$user->name}'!"
            );
	}

	public function showUnsubscribeConfirmation($id){
		$user = DB::table('users')->where('id', '=', $id)->first();

		if($user){
			return view('users.unsubscribeConfirmation', [
				'user' => $user,
			]);

		}
		else{
			// redirect to the users page with error message
			return redirect()
		        ->route('home')
	            ->with(
	                'failure',
	                "This user you attempted to subscribe to does not exist"
	            );
		}
	}

	public function showSubscribeConfirmation($id){
		$user = DB::table('users')->where('id', '=', $id)->first();

		if($user){
			return view('users.subscribeConfirmation', [
				'user' => $user,
			]);

		}
		else{
			// redirect to the users page with error message
			return redirect()
		        ->route('users')
	            ->with(
	                'failure',
	                "This user you attempted to subscribe to does not exist"
	            );
		}
	}
}
