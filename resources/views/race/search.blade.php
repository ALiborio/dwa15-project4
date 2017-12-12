@extends('layouts.master')

@push('head')
<link href="/css/form.css" type='text/css' rel='stylesheet'>
@endpush

@section('content')
<div class="container">
    <div class="search-bar">
        <form action="/race/search">
            <div class="form-row">
                <label for="search-name">Name</label>
                <input type="search" name="name" id="search-name">
                <input type="submit" value="Search" class="search">
            </div> 
        </form>
    </div>
    <hr>
    <div class="results">
        @if ($results->isEmpty())
            <p>
                No races meet the criteria.
            </p>
        @else
            @foreach ($results as $race)
                <div class="result-item">
                    <div class="left">
                        {{ $race->name }}
                    </div>
                    <div class="right-align">
                        <a href="/race/{{ $race->id }}">View</a>
                        @if(Auth::check())
                            @if (Auth::user()->id == $race->user_id)
                             |
                            <a href="/race/{{ $race->id }}/edit">Edit</a> 
                             |
                            <a href="/race/{{ $race->id }}/delete">Delete</a>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection