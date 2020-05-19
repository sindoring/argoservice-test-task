<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cities;

class CitiesController extends Controller
{
    public function index(Request $request){
        return response()->json(Cities::all());
    }

    public function store(Request $request){
        $credentials = $request->all();

        if((new Cities($credentials))->save()){
            return response()->json([
                'message'=>'success'
            ], 201);
        }

        return response()->json([
            'message'=>'fail'
        ], 422);
    }

}
