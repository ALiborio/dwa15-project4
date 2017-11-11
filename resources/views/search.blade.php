@extends('layouts.master')

@push('head')
<link href="/css/form.css" type='text/css' rel='stylesheet'>
@endpush

@section('content')
<div class="container">
    <div class="results">
        @foreach ($results as $character)
            <div class="result-item">
                {{ $character->name.' - Level '.$character->level }}
            </div>
        @endforeach
    </div>
</div>
@endsection