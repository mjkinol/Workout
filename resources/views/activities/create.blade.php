@extends('layouts.main')

@section('title', 'Add New Activity')
@section('header', 'Add New Activity')

@section('content')
    <form method="post" action="/activities">
        @csrf
        <div class="form-group">
            <label for="name">New Activity Name: </label>
            <input type="text" class="form-control" id="name" name="name" value="">
            @error('name')
                <small class="text-danger">{{$message}}</small>
            @enderror
            <br/>
            <label for="category">New Category: </label>
            <input type="text" class="form-control" id="category" name="category" value="">
            @error('category')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div id="createWorkoutButton" class="text-center">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
        <div id="backButton" class="text-center" style="margin-top:10px;">
            <a href="/activities" class="btn btn-secondary">Back</a>
        </div>
    </form>
@endsection