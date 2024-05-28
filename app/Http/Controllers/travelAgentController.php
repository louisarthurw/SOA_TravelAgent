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

        if ($request->has('packages')) {
                $travel_agent->packages()->create([
                ]);
        return response()->json([
            'message' => "Travel Agent Created Successfully"
        ], 200);

    }
}

    public function show($id){
        $travel_agent = travelAgent::with('packages')->findOrFail($id);
        return response()->json($travel_agent);
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

                if ($request->has('packages')) {
                    $travel_agent->packages()->delete();
                    
                    foreach ($request->packages as $packageData) {
                        $travel_agent->packages()->create($packageData);
                    }
                }
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
