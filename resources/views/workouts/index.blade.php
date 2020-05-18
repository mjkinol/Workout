@extends('layouts.main')

@section('title', 'All Workouts')
@section('header', 'All Workouts')

@section('content')
    <table class="table table-striped" style="background-color:#202020; margin-left:40px;">
        <thead style="color:white;">
            <tr>
                <th>Workout</th>
                <th>Category</th>
                <th>Creator</th>
                <th>Likes</th>
                <th>Dislikes</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody style="color:white;">
            @foreach ($workouts as $workout)
                <tr>
                    <td>
                        <a>{{$workout->name}}</a>
                    </td>
                    <td>
                        <a>{{$workout->category}}</a>
                    </td>
                    <td>
                        <a>{{$workout->creator}}</a>
                    </td>
                    <td>
                        <a>{{$workout->likes}}</a>
                    </td>
                    <td>
                        <a>{{$workout->dislikes}}</a>
                    </td>
                    <td>
                        <a href="/workouts/{{$workout->id}}/info" class="btn btn-primary">View</a>
                    </td>
                    @if (Auth::check())
                    <td>
                        <form method="post" action="/workouts/{{$workout->id}}/like" style="display:inline;">
                        @csrf
                            <button id="likes" type="submit" value="{{$workout->likes}}" class="btn btn-success">👍</button>
                        </form>
                        <form method="post" action="/workouts/{{$workout->id}}/dislike" style="display:inline;">
                        @csrf
                            <button type="submit" class="btn btn-danger">👎</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (Auth::check())
    <div id="createWorkoutButton" class="text-center" style="margin-top: 40px; margin-right:90px;">
        <a href="/workouts/new" class="btn btn-primary text-center">Create a Workout</a>
    </div>
    @endif
@endsection