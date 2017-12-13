@extends('layouts.master')


@push('head')
<link href="/css/form.css" type='text/css' rel='stylesheet'>
@endpush

@section('content')
<div class="container profession-form">
    <h1>
        @if(isset($profession))
            Edit Class
        @else
            Create a New Class
        @endif
    </h1>
    <form action="/class{{ isset($profession) ? '/'.$profession->id : '' }}" method="POST">
        @if(isset($profession))
            {{ method_field('put') }}
        @endif
        {{ csrf_field() }}
        <div class="form-row">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $profession->name ?? '') }}">
            @if($errors->get('name'))
                <div class="errors">
                    @foreach($errors->get('name') as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        <h3>Description</h3>
        <textarea name="description" placeholder="Enter a description of this class..." 
   rows="4" cols="50">{{ isset($profession) ? $profession->description : '' }}</textarea>
        </div>
        <div class="form-row submit">
            <input type="submit" 
            value="{{ isset($profession) ? 'Update Class' : 'Create Class' }}" 
        class="submit">
        </div>
    </form>
    @if (isset($profession))
        <a href="{{ url()->previous() }}">Cancel</a>
    @endif
</div>
@endsection