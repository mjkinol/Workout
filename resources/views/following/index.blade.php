@extends('layouts.main')

@section('title', 'Following')
@section('header', 'Following')

@section('content')
    @if ($following)
        <table class="table table-striped" style="background-color:#202020; margin-left:40px;">
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
                            <a href="/profile/{{$user->id}}">{{$user->name}}</a>
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
        <div class="text-center">
            <p>You are not following any users!</p>
        </div>
    @endif
@endsection