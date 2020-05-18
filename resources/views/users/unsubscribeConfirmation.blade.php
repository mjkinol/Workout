@extends('layouts.main')

@section('title', 'Unsubscribe?')
@section('header', 'Unsubscribe')

@section('content')
    <form method="post" action="/users/{{$user->id}}/unsubscribe" class="text-center">
        @csrf
        <p>Are you sure you would like to unsubscribe from '{{$user->name}}'?</p>
        <a href="/users" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-danger">Unsubscribe</button>
    </form>
@endsection