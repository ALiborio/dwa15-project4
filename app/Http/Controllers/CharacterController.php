<?php

namespace GameMaster\Http\Controllers;

use Illuminate\Http\Request;
use GameMaster\Character;
use GameMaster\Profession;
use GameMaster\Race;
use GameMaster\Stat;

class CharacterController extends Controller
{
    private $messages = [
        'name.required_without' => 'Name is required, unless Generate a Random Name is checked.',
        'generatename.required_without' => 'Generate a Random name must be checked, unless you specify a name.',
        'class.required' => 'You must pick a character class.',
        'race.required' => 'You must pick your character\'s race.',
    ];
    private $rules = [
        'name' => 'required_without:generatename',
        'generatename' => 'required_without:name',
        'class' => 'required',
        'race' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Character::with(['profession', 'race'])->get();
        $classList = Profession::all();
        $raceList = Race::all();
        return view('character.search')->with([
            'results' => $results,
            'classList' => $classList,
            'raceList' => $raceList
        ]);
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
        return view('character.form')->with([
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
        # first validate
        $this->validate($request, $this->rules, $this->messages);
        # validation passed, generate new character
        $character = new Character();

        if ($request->input('name') == '') {
            $generator = new \Nubs\RandomNameGenerator\Alliteration();
            $character->name = $generator->getName();
        } else {
            $character->name = $request->input('name');
        }
        
        $character->gender = $request->input('gender');
        $character->race_id = $request->input('race');
        $character->profession_id = $request->input('class');
        $character->lawfulness = $request->input('lawchaos');
        $character->morality = $request->input('goodevil');

        $character->background = $request->input('background');
        
        $character->image = $request->input('image');

        $character->user_id = $request->user()->id;

        #start with a blank character, level 1
        $character->level = 1;

        # save it in the database
        $character->save();

        # randomly generate the stats
        $stats = Stat::all();
        $statList = $character->generateStats($stats);
        $character->stats()->sync($statList);

        return redirect('/character/')->with('alert', 'Character '.$character->name.' was added.');
    }

    /**
     * Search for matching resources
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        # Initiate a query using the `select` method with no params
        # This will will get all the fields from the rows that match our query
        $query = Character::select();

        # Build on the query
        foreach ($request->all() as $field => $term) {
            if ($term != null) {
                if($field == 'race_id' or $field == 'profession_id') {
                    $query->where($field, '=', $term);
                } elseif ($field == 'level') {
                    $query->where($field, '>=', $term);
                } else {
                    $query->where($field, 'LIKE', '%'.$term.'%');
                }
            }
            
        }

        # Execute the query
        $results = $query->with(['profession', 'race'])->get();

        $classList = Profession::all();
        $raceList = Race::all();
        return view('character.search')->with([
                'results' => $results,
                'classList' => $classList,
                'raceList' => $raceList
            ]);
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
            $results = Character::with(['profession', 'race'])->get();
            $classList = Profession::all();
            $raceList = Race::all();
            return view('character.search')->with([
                'results' => $results,
                'classList' => $classList,
                'raceList' => $raceList
            ]);
        } else {
            $result = Character::find($id);
            if ($result == null) {
                return view('character.sheet')->with(['character' => $result]);
            } else {
                $race = Race::find($result->race_id);
                $class = Profession::find($result->profession_id);
                return view('character.sheet')->with([
                    'character' => $result,
                    'race' => $race,
                    'class' => $class
                ]);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $character = Character::find($id);
        if ($character == null) {
            return view('character.sheet')->with(['character' => $character]);
        } elseif ($request->user()->id != $character->user_id) {
            return redirect('/character/'.$id)->with('alert', 'Cannot edit '.$character->name.', you did not create it.');
        } else {
            $classList = Profession::all();
            $raceList = Race::all();

            return view('character.form')->with([
                'character' => $character,
                'classList' => $classList,
                'raceList' => $raceList
            ]);
        }
        
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
        # first validate
        $this->validate($request, $this->rules, $this->messages);
        # validation passed, update character
        $character = Character::find($id);
        $character->name = $request->input('name');
        $character->gender = $request->input('gender');
        $character->race_id = $request->input('race');
        $character->profession_id = $request->input('class');
        $character->lawfulness = $request->input('lawchaos');
        $character->morality = $request->input('goodevil');

        $character->background = $request->input('background');
        
        $character->image = $request->input('image');

        # save it in the database
        $character->save();

        return redirect('/character/'.$id)->with('alert', 'Character '.$character->name.' was updated.');
    }

    /**
     * Show the confirmation for deleting the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $character = Character::find($id);
        $race = Race::find($character->race_id);
        $class = Profession::find($character->profession_id);
        if ($request->user()->id != $character->user_id) {
            return redirect('/character/'.$id)->with('alert', 'Cannot delete '.$character->name.', you did not create it.');
        } else {
            return view('character.delete')->with([
                'character' => $character,
                'race' => $race,
                'class' => $class
            ]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $character = Character::find($id);
        if ($character == null) {
            // This will display the character not found default message.
            return view('character.sheet')->with(['character' => $character]);
        } else {
            $character->stats()->detach();
            $character->delete();
            return redirect('/character/all')->with('alert', 'Character '.$character->name.' was deleted.');
        }
    }
}
