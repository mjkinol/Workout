@extends('layouts.main')

@section('title', 'Subscribers')
@section('header', 'Subscribers')

@section('content')
    @if ($subscribers)
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
                        @if (in_array(strval($user->id), $subscribers))
                        <td>
                            <a href="/profile/{{$user->id}}">{{$user->name}}</a>
                        </td>
                        <td>
                            @if (in_array(strval($user->id), $alreadySubscribed))
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
        <div class="text-center">
            <p>You have no subscribers!</p>
        </div>
    @endif
@endsection