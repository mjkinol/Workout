@extends('layouts.main')

@section('title')
    {{$main_user->name}}'s Profile
@endsection

@section('header')
    {{$main_user->name}}'s Profile
@endsection


@section('content')
    <h4>{{$main_user->name}}'s Created Workouts</h4>
    <hr style="background-color:grey; margin:20px;">
    @if ($myWorkouts)
    <table class="table table-striped" style="background-color:#202020;">
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
        <div>
            <p>{{$main_user->name}} has not created any workouts!</p>
        </div>
    @endif
    <h4>{{$main_user->name}}'s Favorite Workouts</h4>
    <hr style="background-color:grey; margin:20px;">
    @if ($favWorkouts)
    <table class="table table-striped" style="background-color:#202020;">
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
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div>
        <p>{{$main_user->name}} has no favorite workouts!</p>
    </div>
    @endif
    <h4>{{$main_user->name}}'s Subscribers</h4>
    <hr style="background-color:grey; margin:20px;">
    @if ($subscribers)
        <table class="table table-striped" style="background-color:#202020;">
            <thead style="color:white;">
                <tr>
                    <th>Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody style="color:white;">
                @foreach ($users as $user)
                    <tr>
                        @if (in_array(strval($user->id), $subscribers))
                        <td>
                            <a href="/profile/{{$user->id}}">{{$user->name}}</a>
                        </td>
                        <td>
                            @if (in_array(strval($user->id), $subscribers))
                                <a href="/users/{{$user->id}}/unsubscribe" class="btn btn-secondary">Subscribed</a>
                            @else
                                <a href="/users/{{$user->id}}/subscribe" class="btn btn-primary">Subscribe</a>
                            @endif
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div>
            <p>{{$main_user->name}} has no subscribers!</p>
        </div>
    @endif
    <h4>Following</h4>
    <hr style="background-color:grey; margin:20px;">
    @if ($following)
        <table class="table table-striped" style="background-color:#202020;">
            <thead style="color:white;">
                <tr>
                    <th>Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody style="color:white;">
                @foreach ($users as $user)
                    <tr>
                        @if (in_array(strval($user->id), $following))
                        <td>
                            <a>{{$user->name}}</a>
                        </td>
                        <td>
                            <a href="/users/{{$user->id}}/unsubscribe" class="btn btn-secondary">Subscribed</a>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div>
            <p>{{$main_user->name}} is not following any users!</p>
        </div>
    @endif
@endsection