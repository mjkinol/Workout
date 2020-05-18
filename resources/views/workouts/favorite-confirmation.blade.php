@extends('layouts.main')

@section('title')
	Favorite '{{$workout->name}}'?
@endsection

@section('header')
	Favorite '{{$workout->name}}'?
@endsection

@section('content')
    <form method="post" action="/workouts/{{$workout->id}}/favorite" class="text-center">
        @csrf
        <p>Are you sure you want to add '{{$workout->name}}' to your favorite workouts?</p>
        <a href="/workouts/{{$workout->id}}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-success">Add</button>
    </form>
@endsection