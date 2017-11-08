@extends('layouts.master')

@section('title')
Character Sheet
@endsection

@push('head')
<script src="https://use.fontawesome.com/623053ff70.js"></script>
<link href="/css/character.css" type='text/css' rel='stylesheet'>
@endpush

@section('content')
<div class="container">
    <div class="portrait">
        <img src="{{ $character->getImageUrl() }}" width="225" alt="{{ $character->race.' '.$character->gender.' '.$character->class }}" id="characterImg">
    </div>
    <div class="character">
        <h1 id="charName">
            {{ $character->name }} 
        </h1>
        <p>
            {{ $character->race }}
        </p>
        <p>
            {{ $character->gender }}
        </p>
        <p>
            {{ $character->class }}
        </p>
        <p>
            {{ $character->alignment }}
        </p>
    </div>

    <h3> Stats </h3>
    <hr>
    <div class="stats">
        @foreach ($character->stats as $stat => $statNum)
            <h3>
                <span class="attribute-name">{{ ucfirst($stat) }}</span>
                <span class="attribute-num">{{ $statNum }}</span>
            </h3>
        @endforeach
    </div>
    <hr>
    
    <a href="{{ route('index') }}">Start Over</a>
    <a href="{{ url()->full() }}">Regenerate</a>
</div>
@endsection