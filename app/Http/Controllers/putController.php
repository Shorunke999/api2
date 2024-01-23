<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\p_u_t;
use App\Http\Resources\putResource;

class putController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_db = p_u_t::all();
        $data = $data_db->paginate(10);
        return new putResource($data);
    }

    public function search(Request $request)
    {
        $request->validate([
            'search_party_score'=> 'required'
        ]);
        $data_db= p_u_t::where('entered_by_user',LIKE,'%'.$request.'%')
        ->orWhere('party_abbreviation',LIKE,'%'.$request.'%')
        ->orWhere('party_score',LIKE,'%'.$request.'%')
        ->get();
        $data = $data_db->paginate(10);
        return new putResource($data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'result_id' => 'required',
            'polling_unit_uniqueid' => 'required|string',
            'party_abbreviation' => 'required',
            'party_score' => 'required',
            'entered_by_user'=> 'required|string'
        ]);
        $saved_data = p_u_t::create($request);
        return response()->json(['msg' => 'the data have been succesfully save']);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data_db = p_u_t::where('result_id',$id)->get();
        $data = $data_db->paginate(10);
        return new putResource($data);
    }

    public function page()
    {
        return view('welcome');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //this could be access in the web ..
        $request->validate([
                'result_id' => 'required',
                'polling_unit_uniqueid' => 'required|string',
                'party_abbreviation' => 'required',
                'party_score' => 'required',
                'entered_by_user'=> 'required|string'
        ]);
        $data_db =p_u_t::find($id);
        $data= $data_db->update($request);
        return response()->json(['msg'=>'data has been updated']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data_db =p_u_t::find($id);
        $data = $data_db->delete();
    }
}
