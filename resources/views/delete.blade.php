@extends('layouts.master')

@section('title')
GameMaster - Character Sheet
@endsection

@push('head')
<link href="/css/character.css" type='text/css' rel='stylesheet'>
<link href="/css/form.css" type='text/css' rel='stylesheet'>
@endpush

@section('content')

<div class="container">
    @if ($character == null)
        <h3>
            Character not found.
        </h3>
    @else
        <h1>Are you sure you wish to delete this character?</h1>
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
                {{ $character->alignment }}
            </p>
        </div>

        <h3> {{ 'Level '.$character->level }} </h3>
        <hr>
        <div class="stats">
            <h3>
                <span class="attribute-name">Strength</span>
                <span class="attribute-num">{{ $character->strength }}</span>
            </h3>
            <h3>
                <span class="attribute-name">Dexterity</span>
                <span class="attribute-num">{{ $character->dexterity }}</span>
            </h3>
            <h3>
                <span class="attribute-name">Constitution</span>
                <span class="attribute-num">{{ $character->constitution }}</span>
            </h3>
            <h3>
                <span class="attribute-name">Intelligence</span>
                <span class="attribute-num">{{ $character->intelligence }}</span>
            </h3>
            <h3>
                <span class="attribute-name">Wisdom</span>
                <span class="attribute-num">{{ $character->wisdom }}</span>
            </h3>
            <h3>
                <span class="attribute-name">Charisma</span>
                <span class="attribute-num">{{ $character->charisma }}</span>
            </h3>
        </div>
        <hr>
        <form action="/character/{{ $character->id }}" method="POST">
            {{ method_field('delete') }}
            {{ csrf_field() }}
            <div class="form-row submit delete">
                <input type="submit" value="Delete" class="submit delete">
            </div>
        </form>
        <div>
            <a href="/character/{{ $character->id }}">Go Back!</a>
        </div>
    @endif
</div>

@endsection