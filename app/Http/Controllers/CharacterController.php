<?php

namespace GameMaster\Http\Controllers;

use Illuminate\Http\Request;
use GameMaster\Character;
use GameMaster\Profession;
use GameMaster\Race;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classList = Profession::all();
        $raceList = Race::all();
        return view('form')->with([
            'classList' => $classList,
            'raceList' => $raceList
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required_without' => 'Name is required, unless Generate a Random Name is checked.',
            'generatename.required_without' => 'Generate a Random name must be checked, unless you specify a name.',
            'class.required' => 'You must pick a character class.',
            'race.required' => 'You must pick your character\'s race.',
        ];
        $rules = [
            'name' => 'required_without:generatename',
            'generatename' => 'required_without:name',
            'class' => 'required',
            'race' => 'required',
        ];
        # first validate
        $this->validate($request, $rules, $messages);
        # validation passed, generate character object
        $character = new Character();
        $character->name = $request->input('name');
        $character->gender = $request->input('gender');
        #$character->race = $request->input('race');
        #$character->class = $request->input('class');
        if ($request->input('lawchaos') == 'neutral' && $request->input('goodevil') == 'neutral') {
            $character->alignment = 'true neutral';
        } elseif ($request->has('lawchaos') && $request->has('goodevil')) {
            $character->alignment = $request->input('lawchaos').' '.$request->input('goodevil');
        } elseif ($request->has('lawchaos')) {
            $character->alignment = $request->input('lawchaos');
        } elseif ($request->has('goodevil')) {
            $character->alignment = $request->input('goodevil');
        }
        #start with a blank character, level 1 - all stats at 0.
        $character->level = 1;
        $character->strength = 0;
        $character->dexterity = 0;
        $character->constitution = 0;
        $character->intelligence = 0;
        $character->wisdom = 0;
        $character->charisma = 0;

        # save it in the database
        $character->save();

        return redirect('/character');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id == 'all') {
            $results = Character::all();
            return view('search')->with(['results' => $results]);
        } else {
            $result = Character::find($id);
            return view('sheet')->with(['character' => $result]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
