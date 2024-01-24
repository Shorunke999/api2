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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data_db = p_u_t::where('result_id',$id)->first();
        if($data_db){
            return new putResource($data_db);
        }else{
           return new modelException('resources does not exist');
        }
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
