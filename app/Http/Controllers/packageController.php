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
            'flight_id' => 'nullable|exists:ticket,id',
            'hotel_id' => 'nullable|exists:hotel_reservation,id',
            'attraction_id' => 'nullable|exists:e_ticket,id',
            'price' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                "message" => "Invalid data provided",
                "errors" => $validator->errors()
            ], 422);
        }
    
        $package = Package::create([
            'travel_agent_id' => $request->travel_agent_id,
            'flight_id' => $request->flight_id,
            'hotel_id' => $request->hotel_id,
            'attraction_id' => $request->attraction_id,
            'price' => $request->price,
        ]);
    
        return response()->json([
            'message' => "Package Created Successfully",
            'package' => $package
        ], 201);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'flight_id' => 'nullable|exists:ticket,id',
            'hotel_id' => 'nullable|exists:hotel_reservation,id',
            'attraction_id' => 'nullable|exists:e_ticket,id',
            'price' => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                "message" => "Invalid data provided",
                "errors" => $validator->errors()
            ], 422);
        }
    
        $package = Package::findOrFail($id);
        $package->update([
            'flight_id' => $request->flight_id,
            'hotel_id' => $request->hotel_id,
            'attraction_id' => $request->attraction_id,
            'price' => $request->price,
        ]);
    
        return response()->json([
            'message' => "Package Updated Successfully",
            'package' => $package
        ], 200);
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
