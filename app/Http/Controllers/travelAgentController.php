<?php

namespace App\Http\Controllers;

use App\Models\travelAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class travelAgentController extends Controller
{
    public function index(){
        $travel_agent = travelAgent::get();
        if($travel_agent->count() > 0){
            return response()->json([
                'Travel Agent' => $travel_agent,
            ],200);
        }else{
            return response()->json([
                "message" => 'No Records Found'
            ],404);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'contact_info' => 'required|string',
            //package" nya dibuat enum aja kalo mau
        ]);
    }
}
