@extends('layouts.master')

@push('head')
<link href="/css/form.css" type='text/css' rel='stylesheet'>
@endpush

@section('content')
<div class="container">
    <div class="search-bar">
        <form action="/character/search">
            <div class="form-row">
                <label for="search-name">Name</label>
                <input type="search" name="name" id="search-name">
                <label for="race">Race</label>
                <select id="race" name="race_id">
                    <option value="">Any</option>
                    @foreach($raceList as $race)
                        <option value="{{ $race->id }}" @if (old('race') == $race->id) selected @endif>
                            {{ ucfirst($race->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-row">
                <label for="class">Class</label>
                <select id="class" name="class_id">
                    <option value="">Any</option>
                    @foreach($classList as $class)
                        <option value="{{ $class->id }}" @if (old('class') == $class->id) selected @endif>
                            {{ ucfirst($class->name) }}
                        </option>
                    @endforeach
                </select>
                <label>Min Lvl</label>
                <input type="number" name="level" min="1" id="search-lvl">
                <input type="submit" value="Search" class="search">
            </div> 
        </form>
    </div>
    <hr>
    <div class="results">
        @if ($results->isEmpty())
            <p>
                No characters meet the criteria.
            </p>
        @else
            @foreach ($results as $character)
                <div class="result-item">
                    {{ $character->name.' - Level '.$character->level }}
                    <a href="/character/{{ $character->id }}"> View </a>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection