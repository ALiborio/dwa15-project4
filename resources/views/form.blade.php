@extends('layouts.master')


@push('head')
<link href="/css/form.css" type='text/css' rel='stylesheet'>
@endpush

@section('content')
<div class="container">
    <h1>
        @if(isset($character))
            Edit Character
        @else
            Create Your Character
        @endif
    </h1>
    <form action="{{ isset($character) ? '/character/edit/'.$character->id : '/character' }}" method="POST">
        {{ csrf_field() }}
        <div class="form-row">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $character->name ?? '') }}">
            @if($errors->get('name'))
                <div class="errors">
                    @foreach($errors->get('name') as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
                
            <div class='radio-group'>
                <label class='radio-label'>
                    <input type="checkbox" name="generatename" id="generatename" @if (old('generatename')) CHECKED @endif>
                    <span class='inner-label sublabel'>Generate a random name</span>
                </label>
            </div>
            @if($errors->get('generatename'))
            <div class="errors">
                @foreach($errors->get('generatename') as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
        </div>
        <div class='radio-group'>
            <label class='radio-label'>
                <input name='gender' type='radio' id='male' value='male' {{ (old('gender', $character->gender ?? '') == 'male') ? 'CHECKED' : '' }}>
                <span class='inner-label'>Male</span>
           </label>
           <label class='radio-label'>
                <input name='gender' type='radio' id='female' value='female' {{ (old('gender', $character->gender ?? '') == 'female') ? 'CHECKED' : '' }}>
                <span class='inner-label'>Female</span>
           </label>
        </div>
        <div class="form-row">
            <label for="class">Class</label>
            <select id="class" name="class">
                <option value="">-- pick a class --</option>
                @foreach($classList as $class)
                    <option value="{{ $class->id }}" {{ (old('class', $character->class_id ?? '') == $class->id) ? 'selected' : '' }}>
                        {{ ucfirst($class->name) }}
                    </option>
                @endforeach
            </select>
        </div>
        @if($errors->get('class'))
            <div class="errors">
               @foreach($errors->get('class') as $error)
                   <p>{{ $error }}</p>
               @endforeach
            </div>
        @endif
        <div class="form-row">
            <label for="race">Race</label>
            <select id="race" name="race">
                <option value="">-- pick a race --</option>
                @foreach($raceList as $race)
                    <option value="{{ $race->id }}" {{ (old('race', $character->race_id ?? '') == $race->id) ? 'selected' : '' }}>
                        {{ ucfirst($race->name) }}
                    </option>
                @endforeach
            </select>
        </div>
        @if($errors->get('race'))
            <div class="errors">
                @foreach($errors->get('race') as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <h3>Background</h3>
        <textarea name="background"
   rows="4" cols="50">{{ isset($character) ? $character->background : 'Enter some background about your character...' }}
        </textarea>
        <h3 class="alignment">Alignment</h3>
        <div class="alignment-radios">
            <div class="radio-group">
                <label class="radio-label">
                    <input name="lawchaos" type="radio" id="lawful" value="lawful" {{ (old('lawchaos', $alignment['lawchaos'] ?? '') == 'lawful') ? 'CHECKED' : '' }}>
                    <span class="inner-label">Lawful</span>
                </label>
                <label class="radio-label">
                    <input name="lawchaos" type="radio" id="lcneutral" value="neutral" {{ (old('lawchaos', $alignment['lawchaos'] ?? '') == 'neutral') ? 'CHECKED' : '' }}>
                    <span class="inner-label">Neutral</span>
                </label>
                <label class="radio-label">
                    <input name="lawchaos" type="radio" id="chaotic" value="chaotic" {{ (old('lawchaos', $alignment['lawchaos'] ?? '') == 'chaotic') ? 'CHECKED' : '' }}>
                    <span class="inner-label">Chaotic</span>
                </label>
            </div>
            @if($errors->get('lawchaos'))
                <div class="errors">
                    @foreach($errors->get('lawchaos') as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="radio-group">
                <label class="radio-label">
                    <input name="goodevil" type="radio" id="good" value="good" {{ (old('goodevil', $alignment['goodevil'] ?? '') == 'good') ? 'CHECKED' : '' }}>
                    <span class="inner-label">Good&nbsp;&nbsp;&nbsp;</span>
                </label>
                <label class="radio-label">
                    <input name="goodevil" type="radio" id="geneutral" value="neutral" {{ (old('goodevil', $alignment['goodevil'] ?? '') == 'neutral') ? 'CHECKED' : '' }}>
                    <span class="inner-label">Neutral</span>
                </label>
                <label class="radio-label">
                    <input name="goodevil" type="radio" id="evil" value="evil" {{ (old('goodevil', $alignment['goodevil'] ?? '') == 'evil') ? 'CHECKED' : '' }}>
                    <span class="inner-label">Evil</span>
                </label>
            </div>
            @if($errors->get('goodevil'))
                <div class="errors">
                    @foreach($errors->get('goodevil') as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="form-row submit">
            <input type="submit" 
            value="{{ isset($character) ? 'Update Character' : 'Create Character' }}" 
        class="submit">
        </div>
    </form>
</div>
@endsection
