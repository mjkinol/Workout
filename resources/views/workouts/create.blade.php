@extends('layouts.main')

@section('title', 'Create New Workout')
@section('header', 'Create New Workout')

@section('content')
    <form method="post" action="/workouts">
        @csrf
        <div class="form-group">
            <label for="name">New Workout Name: </label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <br/>
            <label for="category">New Category: </label>
            <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}">
            @error('category')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <br/>
            <label for="routine">New Routine: </label>
            <textarea class="form-control"
                      id="routine"
                      name="routine"
                      value="{{ old('routine') }}"
                      rows="5"></textarea>
            @error('routine')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <br/>
            <label for="description">New Description: </label>
            <textarea class="form-control"
                      id="description"
                      name="description"
                      value="{{ old('description') }}"
                      rows="3"></textarea>
            @error('description')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div id="createWorkoutButton" class="text-center">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
        <div id="backButton" class="text-center" style="margin-top:10px;">
            <a href="/workouts" class="btn btn-secondary">Back</a>
        </div>
    </form>
@endsection