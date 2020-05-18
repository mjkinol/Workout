@extends('layouts.main')

@section('title', 'My Favorite Workouts')
@section('header', 'My Favorite Workouts')

@section('content')
    @if ($favWorkouts)
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
                        @if (in_array(strval($workout->id), $favWorkouts))
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
                        <td>
                            <a href="/workouts/{{$workout->id}}/unfavorite" class="btn btn-danger text-center">
                                Remove
                            </a>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="text-center">
            <p>You have no favorite workouts!</p>
        </div>
    @endif
@endsection