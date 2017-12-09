@extends('layouts.master')

@section('title')
GameMaster - Character Sheet
@endsection

@push('head')
<link href="/css/character.css" type='text/css' rel='stylesheet'>
@endpush

@section('content')

<div class="container">
    @if ($character == null)
        <h3>
            Character not found.
        </h3>
    @else
        <div class="portrait">
            <img src="{{ asset('/images/defaultChar.png') }}" width="225" alt="{{ $character->name }}" id="characterImg">
        </div>
        <div class="character">
            <h1 id="charName">
                {{ $character->name }} 
            </h1>
            <p>
                {{ $race->name }}
            </p>
            <p>
                {{ $character->gender }}
            </p>
            <p>
                {{ $class->name }}
            </p>
            <p>
                {{ $character->alignment() }}
            </p>
        </div>
        @if($character->background)
            <hr>
            <div class="background-text">
                {{ $character->background }}
            </div>
        @endif
        <hr>
        <h3> {{ 'Level '.$character->level }} </h3>
        <hr>
        <div class="stats">
            @foreach($character->stats as $stat)
                <h4>
                    <span class="attribute-name">{{ $stat->name }}</span>
                    <span class="attribute-num">{{ $stat->pivot->value }}</span>
                </h4>
            @endforeach
        </div>
        <hr>
        @if (Auth::user()->id == $character->user_id)
            <a href="/character/{{ $character->id }}/edit">Edit</a>
            |
            <a href="/character/{{ $character->id }}/delete">Delete</a>
        @endif
        <p>Created by {{ $character->user->name }}</p>
    @endif
</div>

@endsection