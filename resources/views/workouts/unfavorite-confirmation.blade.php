@extends('layouts.main')

@section('title')
	Remove Favorite?
@endsection

@section('header')
	Remove '{{$workout->name}}' From Favorites
@endsection

@section('content')
    <form method="post" action="/workouts/{{$workout->id}}/unfavorite" class="text-center">
        @csrf
        <p>Are you sure you want to remove '{{$workout->name}}' from your favorite workouts?</p>
        <a href="/workouts/{{$workout->id}}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-danger">Remove</button>
    </form>
@endsection