@extends('layouts.master')

@section('title')
GameMaster - Delete Race
@endsection

@push('head')
<link href="/css/character.css" type='text/css' rel='stylesheet'>
<link href="/css/form.css" type='text/css' rel='stylesheet'>
@endpush

@section('content')

<div class="container">
    @if ($race == null)
        <h3>
            Race not found.
        </h3>
    @else
        <div class="race">
            <h1 id="charName">
                {{ $race->name }}
            </h1>
            <hr>
            <p>
                {{ $race->description }}
            </p>
        </div>
        <h1>Are you sure you wish to delete this race?</h1>

        <form action="/race/{{ $race->id }}" method="POST">
            {{ method_field('delete') }}
            {{ csrf_field() }}
            <div class="form-row submit delete">
                <input type="submit" value="Delete" class="submit delete">
            </div>
        </form>
        <div>
            <a href="{{ url()->previous() }}">Go Back!</a>
        </div>
    @endif
</div>

@endsection