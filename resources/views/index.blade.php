@extends('layouts.main')

@section('title', 'Home')

@section('header', 'Home')

@section('content')
	@if (Auth::check())
		<h1 class="text-center" style="background-color:#202020; padding:30px;">
			Welcome back, {{Auth::user()->name}}!
		</h1>
	@else
		<h2 class="text-center" style="background-color:#202020; padding:30px;">
			Hello! Please sign in or create an account.
		</h2>
	@endif
@endsection