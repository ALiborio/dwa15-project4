@extends('layouts.master')


@push('head')
<link href="/css/form.css" type='text/css' rel='stylesheet'>
@endpush

@section('content')
<div class="container race-form">
    <h1>
        @if(isset($race))
            Edit Race
        @else
            Create a New Race
        @endif
    </h1>
    <form action="/race{{ isset($race) ? '/'.$race->id : '' }}" method="POST">
        @if(isset($race))
            {{ method_field('put') }}
        @endif
        {{ csrf_field() }}
        <div class="form-row">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $race->name ?? '') }}">
            @if($errors->get('name'))
                <div class="errors">
                    @foreach($errors->get('name') as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <h3>Description</h3>
            <textarea name="description" placeholder="Enter a description of this race..." 
       rows="4" cols="50">{{ isset($race) ? $race->description : '' }}</textarea>
        </div>
        <div class="form-row">
            <h3>Stat Modifiers</h3>
            @foreach($stats as $stat)
            <div>
                <label for="{{ $stat->name }}">{{ $stat->name }}</label>
                @if (isset($race))
                <input type="number" name="{{ $stat->name }}" id="{{ $stat->name }}" value="{{ old($stat->name, $race->stats->where('id', $stat->id)->first()->pivot->modifier ?? '') }}" class="stat-modifier" min="-10" max="10">
                @else
                <input type="number" name="{{ $stat->name }}" id="{{ $stat->name }}" value="{{ old($stat->name) }}" class="stat-modifier" min="-10" max="10">
                @endif
            </div>
            @endforeach
        </div>
        <div class="form-row submit">
            <input type="submit" 
            value="{{ isset($race) ? 'Update Race' : 'Create Race' }}" 
        class="submit">
        </div>
    </form>
    @if (isset($race))
        <a href="{{ url()->previous() }}">Cancel</a>
    @endif
</div>
@endsection