@extends('layouts.master')

@section('title')
GameMaster - Race
@endsection

@push('head')
<link href="/css/character.css" type='text/css' rel='stylesheet'>
@endpush

@section('content')

<div class="container">
    @if ($race == null)
        <h3>
            Race not found.
        </h3>
    @else
            <h1 id="charName">
                {{ $race->name }} 
            </h1>
        @if($race->description)
            <hr>
            <div class="background-text">
                {{ $race->description }}
            </div>
        @endif
        <hr>
        <h3>Bonus Stats</h3>
        <hr>
        <div class="stats">
            @foreach($race->stats as $stat)
                <h4>
                    <span class="attribute-name">{{ $stat->name }}</span>
                    <span class="attribute-num">{{ $stat->pivot->modifier }}</span>
                </h4>
            @endforeach
        </div>
        <hr>
        @if (Auth::check())
            @if (Auth::user()->id == $race->user_id)
                <a href="/race/{{ $race->id }}/edit">Edit</a>
                |
                <a href="/race/{{ $race->id }}/delete">Delete</a>
            @endif
        @endif
        <p>Created by {{ $race->user->name }}</p>
    @endif
</div>

@endsection