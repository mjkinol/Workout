@extends('layouts.main')

@section('title', 'Activities')
@section('header', 'Activities')

@section('content')
    <table class="table table-striped" style="background-color:#202020; margin-left:40px;">
        <thead style="color:white;">
            <tr>
                <th>Activity</th>
                <th>Category</th>
                <th>Likes</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody style="color:white;">
            @foreach ($activities as $activity)
                <tr>
                    <td>
                        <a>{{$activity->name}}</a>
                    </td>
                    <td>
                        <a>{{$activity->category}}</a>
                    </td>
                    <td>
                        <a>{{$activity->likes}}</a>
                    </td>
                    <td>
                        <a href="/activities/{{$activity->id}}/thread" class="btn btn-primary">Discussion</a>
                    </td>
                    @if (Auth::check())
                    <td>
                        <form method="post" action="/activities/{{$activity->id}}/like"">
                        @csrf
                            <button id="likes" type="submit" value="{{$activity->likes}}" class="btn btn-success">👍</button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (Auth::check())
    <div id="createActivityButton" class="text-center" style="margin-top: 40px;">
        <a href="/activities/new" class="btn btn-primary text-center">Add Activity</a>
    </div>
    @endif
@endsection