@extends('layouts.master')

@push('head')
<link href="/css/form.css" type='text/css' rel='stylesheet'>
@endpush

@section('content')
<div class="container">
    <div class="results">
        @if ($results->isEmpty())
            <p>
                There are no characters.
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