<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class FollowingController extends Controller
{
	public function index(){
		$users = DB::table('users')->get();
		$following = DB::table('subscribe')->where('user', '=', Auth::user()->id)->pluck("subscribedTo")->toArray();

		return view('following.index', [
			'users' => $users,
			'following' => $following
		]);
	}
}
