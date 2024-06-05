<?php

namespace App\Http\Controllers;

use App\Models\package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class packageController extends Controller
{
    public function index($id){
        $package = package::where('travel_agent_id', $id)->with('detail')->get();
        if($package->count() > 0){
            return response()->json([
                'Travel Agent' => $id,
                'Package' => $package,
            ],200);
        }else{
            return response()->json([
                "message" => 'No Records Found'
            ],404);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'travel_agent_id' => 'required|exists:travel_agent,id',
            'description' => 'required|string',
            'departure_date' => 'required|date',
            'return_date' => 'required|date',
            'number_of_people' => 'required|integer',
            'price' => 'required|integer',
            'quota' => 'required|integer'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                "message" => "Invalid data provided",
                "errors" => $validator->errors()
            ], 422);
        }
    
        $package = Package::create([
            'travel_agent_id' => $request->travel_agent_id,
            'description' => $request->description,
            'departure_date' => $request->departure_date,
            'return_date' => $request->return_date,
            'number_of_people' => $request->number_of_people,
            'price' => $request->price,
            'quota' => $request->quota
        ]);
    
        return response()->json([
            'message' => "Package Created Successfully",
            'package' => $package
        ], 201);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'departure_date' => 'required|date',
            'return_date' => 'required|date',
            'number_of_people' => 'required|integer',
            'price' => 'required|integer',
            'quota' => 'required|integer'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                "message" => "Invalid data provided",
                "errors" => $validator->errors()
            ], 422);
        }
    
        $package = Package::find($id);
        if(!$package){
            return response()->json([
                "message" => "Package not found"
            ],404);
        }else{
        $package->update([
            'description' => 'required|string',
            'departure_date' => $request->departure_date,
            'return_date' => $request->return_date,
            'number_of_people' => $request->number_of_people,
            'price' => $request->price,
            'quota' => $request->quota
        ]);
        return response()->json([
            'message' => "Package Updated Successfully",
            'package' => $package
        ], 200);
    }
}

    public function destroy($id){
        $package = Package::find($id);
    if($package){
        $package->delete();
        return response()->json([
            'message' => "Package Deleted Successfully"
        ], 200);
    }else{
        return response()->json([
            'message' => "No Package Found"
        ], 404);
    }
}

    public function edit($id){
        //
    }
}
