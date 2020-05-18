@extends('layouts.main')

@section('title')
    @if ($workout)
        Workout: {{$workout->name}}
    @else
        Workout not found
    @endif
@endsection

@section('header')
    @if ($workout)
        Details
    @else
        Workout not found
    @endif
@endsection

@section('content')
    @if ($workout)
        <div id="overview" class="col-sm text-center">
            <h4>
                Workout: {{$workout->name}}
            </h4>
            <h5>
                by {{$workout->creator}}
            </h5>
        </div>
        <div id="details" class="col-lg" style="background-color:#202020; padding:20px; margin-top: 40px;">
            <h2>Routine</h2>
            <p>{{$workout->routine}}</p>
            <hr style="background-color:white; margin:40px;">
            <h4 style="color:gray">Description</h4>
            <p style="color:gray">{{$workout->description}}</p>
        </div>
    @if (Auth::check())
        <div id="addToFavWorkoutsButton" class="text-center" style="margin-top: 40px;">
            <a href="/workouts/{{$workout->id}}/favorite" class="btn btn-success text-center">Add To FavWorkouts</a>
        </div>
        @if(Auth::user()->name === $workout->creator)
            <div id="editWorkoutButton" class="text-center" style="margin-top: 10px;">
                <a href="/workouts/{{$workout->id}}/edit" class="btn btn-primary text-center">Edit Your Workout</a>
            </div>
            <div id="removeWorkoutButton" class="text-center" style="margin-top: 10px;">
                <a href="/workouts/{{$workout->id}}/delete" class="btn btn-danger text-center">Remove Your Workout Permanently</a>
            </div>
        @endif
    @endif
        <div id="backButton" class="text-center" style="margin-top:10px;">
            <a href="/workouts" class="btn btn-secondary">Back</a>
        </div>
    @else
        <p>Workout not found.</p>
    @endif
@endsection