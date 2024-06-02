<?php

namespace App\Http\Controllers;

use App\Models\travelAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class travelAgentController extends Controller
{
    public function index(){
        $travel_agent = travelAgent::with('packages')->get();
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'contact_info' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "invalid data provided"
            ], 422);
        }

        $travel_agent = travelAgent::create([
            'name' => $request->name,
            'contact_info' => $request->contact_info
            
        ]);
        return response()->json([
            'message' => "Travel Agent Created Successfully",
            'travel_agent' => $travel_agent
        ], 201);
}

    public function show($id){
        $travel_agent = travelAgent::with('packages')->find($id);
        if($travel_agent){
            return response()->json([
                "Travel Agent" => $travel_agent
            ]);
        }else{
            return response()->json([
                'message' => "Travel Agent Not Found"
            ], 404);
        }
    }

    public function create(){
        // menamplikan form
    }

    public function edit($id){
        // nampilin form edit
    }

    public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'contact_info' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json([
                'message' => 'No Travel Agent found'
            ],404);
        }else{
            $travel_agent = travelAgent::find($id);
            if($travel_agent){
                $travel_agent->update([
                    'name' => $request->name,
                    'contact_info' => $request->contact_info,
                ]);
            }
        }
    }
    

    public function destroy($id){
        $travel_agent = travelAgent::find($id);
        if($travel_agent){
            $travel_agent->delete();
            return response()->json([
                'message' => "Travel Agent Deleted"
            ]);
        }else{
            return response()->json([
                'message' => "No Travel Agent Found"
            ],404);
        }
    }
}
