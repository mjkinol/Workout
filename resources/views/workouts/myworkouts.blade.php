@extends('layouts.main')

@section('title', 'My Created Workouts')
@section('header', 'My Created Workouts')

@section('content')
    @if ($myWorkouts)
        <table class="table table-striped" style="background-color:#202020; margin-left:40px;">
            <thead style="color:white;">
                <tr>
                    <th>Workout</th>
                    <th>Category</th>
                    <th>Creator</th>
                    <th>Likes</th>
                    <th>Dislikes</th>
                    <th></th>
                </tr>
            </thead>
            <tbody style="color:white;">
                @foreach ($workouts as $workout)
                    <tr>
                        @if (in_array(strval($workout->id), $myWorkouts))
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
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="text-center">
            <p>You have not created any workouts!</p>
        </div>
    @endif
@endsection