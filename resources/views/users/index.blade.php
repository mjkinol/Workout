@extends('layouts.main')

@section('title', 'All Users')
@section('header', 'All Users')

@section('content')
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
                    <td>
                        <a href="/profile/{{$user->id}}">{{$user->name}}</a>
                    </td>
                    <td>
                        @if ($user->id === $authId)
                        @elseif (in_array(strval($user->id), $alreadySubscribed))
                            <a href="/users/{{$user->id}}/unsubscribe" class="btn btn-secondary">Subscribed</a>
                        @else
                            <a href="/users/{{$user->id}}/subscribe" class="btn btn-primary">Subscribe</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection