@extends('layouts.main')

@section('title', 'Subscribe?')
@section('header', 'Subscribe')

@section('content')
    <form method="post" action="/users/{{$user->id}}/subscribe" class="text-center">
        @csrf
        <p>You would like to subscribe to '{{$user->name}}'?</p>
        <a href="/users" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-success">Subscribe</button>
    </form>
@endsection