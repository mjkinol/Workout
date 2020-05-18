@extends('layouts.main')

@section('title')
  Edit '{{ $workout->name }}'
@endsection

@section('header')
  Edit '{{ $workout->name }}'
@endsection

@section('content')
    <form method="post" action="/workouts/{{$workout->id}}/edit">
        @csrf
        <div class="form-group">
            <label for="name">Workout Name: </label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $workout->name }}">
            @error('name')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <br/>
            <label for="category">Category Name: </label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $workout->category }}">
            @error('category')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <br/>
            <label for="routine">Routine: </label>
            <textarea class="form-control"
                      id="routine"
                      name="routine"
                      value="{{ $workout->routine }}"
                      rows="5">{{ $workout->routine }}</textarea>
            @error('routine')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <br/>
            <label for="description">Description: </label>
            <textarea class="form-control"
                      id="description"
                      name="description"
                      value="{{ $workout->description }}"
                      rows="3">{{ $workout->description }}</textarea>
            @error('description')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div id="createWorkoutButton" class="text-center">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        <div id="backButton" class="text-center" style="margin-top:10px;">
          <a href="/workouts/{{$workout->id}}" class="btn btn-secondary">Back</a>
        </div>
    </form>
@endsection