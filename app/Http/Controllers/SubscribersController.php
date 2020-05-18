<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class SubscribersController extends Controller
{
	public function index(){
		$users = DB::table('users')->get();
		$subscribers = DB::table('subscribe')->where('subscribedTo', '=', Auth::user()->id)->pluck("user")->toArray();
		$alreadySubscribed = DB::table('subscribe')->where('user', '=', Auth::user()->id)->pluck("subscribedTo")->toArray();

		return view('subscribers.index', [
			'users' => $users,
			'subscribers' => $subscribers,
			'alreadySubscribed' => $alreadySubscribed
		]);
	}
}
