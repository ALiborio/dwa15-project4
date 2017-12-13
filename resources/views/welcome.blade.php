@extends('layouts.master')

@section('content')
<div class="container welcome">
    <h1 class="game-master">GameMaster</h1>

    <div>
        <img src="{{ asset('images/d20.png') }}" alt="GameMaster">
    </div>

    <p>
        Welcome to <span class="game-master"><strong>GameMaster</strong></span>!
    </p>

    <p>
        Create role-playing characters, manage them, and share them with your friends. Create a party and level up together!
    </p>
</div>
@endsection