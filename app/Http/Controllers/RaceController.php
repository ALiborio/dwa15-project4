<?php

namespace GameMaster\Http\Controllers;

use Illuminate\Http\Request;
use GameMaster\Race;
use GameMaster\Stat;

class RaceController extends Controller
{
    private $rules = [
        'name' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Race::all();
        return view('race.search')->with([
            'results' => $results
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stats = Stat::all();
        return view('race.form')->with([
            'stats' => $stats
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
        $this->validate($request, $this->rules);
        # validation passed, generate new Race
        $race = new Race();

        $race->name = $request->input('name');
        $race->description = $request->input('description');
        $race->user_id = $request->user()->id;

        # save it in the database
        $race->save();

        return redirect('/race/')->with('alert', 'Race '.$race->name.' was added.');
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
        $query = Race::select();

        # Build on the query
        foreach ($request->all() as $field => $term) {
            $query->where($field, 'LIKE', '%'.$term.'%');            
        }

        # Execute the query
        $results = $query->get();

        return view('race.search')->with(['results' => $results]);
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
            $results = Race::all();
            return view('race.search')->with(['results' => $results]);
        } else {
            $result = Race::find($id);
            return view('race.view')->with(['race' => $result]);
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
        $race = Race::find($id);
        if ($race == null) {
            return view('race.show')->with(['race' => $race]);
        } elseif ($request->user()->id != $race->user_id) {
            return redirect('/race/'.$id)->with('alert', 'Cannot edit '.$race->name.', you did not create it.');
        } else {
            $stats = Stat::with('races')->get();
            return view('race.form')->with([
                'race' => $race,
                'stats' => $stats
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
        $this->validate($request, $this->rules);
        # validation passed, generate new Race
        $race = Race::find($id);

        $race->name = $request->input('name');
        $race->description = $request->input('description');

        # save it in the database
        $race->save();

        return redirect('/race/')->with('alert', 'Race '.$race->name.' was updated.');
    }

    /**
     * Show the confirmation for deleting the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $race = Race::find($id);
        if ($request->user()->id != $race->user_id) {
            return redirect('/race/'.$id)->with('alert', 'Cannot delete '.$race->name.', you did not create it.');
        } else {
            return view('race.delete')->with(['race' => $race]);
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
        $race = Race::find($id);
        if ($race == null) {
            // This will display the race not found default message.
            return view('race.view')->with(['race' => $race]);
        } else {
            // $race->stats()->detach();
            $race->delete();
            return redirect('/race/all')->with('alert', 'Race '.$race->name.' was deleted.');
        }
    }
}
