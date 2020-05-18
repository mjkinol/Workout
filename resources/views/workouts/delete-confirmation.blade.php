@extends('layouts.main')

@section('title', 'Delete Workout')
@section('header', 'Delete Workout')

@section('content')
    <form method="post" action="/workouts/{{$workout->id}}/delete" class="text-center">
        @csrf
        <p>Are you sure you want to delete your '{{$workout->name}}' workout?</p>
        <a href="/workouts/{{$workout->id}}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection