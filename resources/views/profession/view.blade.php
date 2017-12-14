@extends('layouts.master')

@section('title')
GameMaster - Class
@endsection

@push('head')
<link href="/css/character.css" type='text/css' rel='stylesheet'>
@endpush

@section('content')

<div class="container">
    @if ($profession == null)
        <h3>
            Class not found.
        </h3>
    @else
            <h1 id="charName">
                {{ $profession->name }} 
            </h1>
        @if($profession->description)
            <hr>
            <div class="background-text">
                {{ $profession->description }}
            </div>
        @endif
        <hr>
        <h3>Bonus Stats</h3>
        <hr>
        <div class="stats">
            @foreach($profession->stats as $stat)
                <h4>
                    <span class="attribute-name">{{ $stat->name }}</span>
                    <span class="attribute-num">{{ $stat->pivot->ranking }}</span>
                </h4>
            @endforeach
        </div>
        <hr>
        @if (Auth::check())
            @if (Auth::user()->id == $profession->user_id)
                <a href="/class/{{ $profession->id }}/edit">Edit</a>
                |
                <a href="/class/{{ $profession->id }}/delete">Delete</a>
            @endif
        @endif
        <p>Created by {{ $profession->user->name }}</p>
    @endif
</div>

@endsection