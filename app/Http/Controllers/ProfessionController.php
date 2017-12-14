<?php

namespace GameMaster\Http\Controllers;

use Illuminate\Http\Request;
use GameMaster\Profession;
use GameMaster\Stat;

class ProfessionController extends Controller
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
        $results = Profession::all();
        return view('profession.search')->with([
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
        return view('profession.form')->with([
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
        # validation passed, generate new Profession
        $profession = new Profession();

        $profession->name = $request->input('name');
        $profession->description = $request->input('description');
        $profession->user_id = $request->user()->id;

        # save it in the database
        $profession->save();

        $statList[$request->input('primary')] = ['ranking' => 'primary'];
        $statList[$request->input('secondary')] = ['ranking' => 'secondary'];
        $profession->stats()->sync($statList); 

        return redirect('/class/')->with('alert', 'Class '.$profession->name.' was added.');
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
        $query = Profession::select();

        # Build on the query
        foreach ($request->all() as $field => $term) {
            $query->where($field, 'LIKE', '%'.$term.'%');            
        }

        # Execute the query
        $results = $query->get();

        return view('profession.search')->with(['results' => $results]);
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
            $results = Profession::all();
            return view('profession.search')->with(['results' => $results]);
        } else {
            $result = Profession::find($id);
            return view('profession.view')->with(['profession' => $result]);
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
        $profession = Profession::find($id);
        if ($profession == null) {
            return view('profession.show')->with(['profession' => $profession]);
        } elseif ($request->user()->id != $profession->user_id) {
            return redirect('/class/'.$id)->with('alert', 'Cannot edit '.$profession->name.', you did not create it.');
        } else {
            $stats = Stat::with('professions')->get();
            return view('profession.form')->with([
                'profession' => $profession,
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
        # validation passed, generate new Profession
        $profession = Profession::find($id);

        $profession->name = $request->input('name');
        $profession->description = $request->input('description');

        # save it in the database
        $profession->save();

        $statList[$request->input('primary')] = ['ranking' => 'primary'];
        $statList[$request->input('secondary')] = ['ranking' => 'secondary'];
        $profession->stats()->sync($statList); 

        return redirect('/class/')->with('alert', 'Class '.$profession->name.' was updated.');
    }

    /**
     * Show the confirmation for deleting the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $profession = Profession::find($id);
        if ($request->user()->id != $profession->user_id) {
            return redirect('/class/'.$id)->with('alert', 'Cannot delete '.$profession->name.', you did not create it.');
        } else {
            return view('profession.delete')->with(['profession' => $profession]);
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
        $profession = Profession::find($id);
        if ($profession == null) {
            // This will display the class not found default message.
            return view('profession.view')->with(['profession' => $profession]);
        } else {
            $profession->stats()->detach();
            $profession->delete();
            return redirect('/class/all')->with('alert', 'Class '.$profession->name.' was deleted.');
        }
    }
}
