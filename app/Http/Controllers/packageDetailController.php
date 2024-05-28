<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\packageDetail;
use Illuminate\Support\Facades\Validator;

class packageDetailController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|exists:package,id',
            'description' => 'required|string',
            'origin_city' => 'required|string',
            'destination_city' => 'required|string',
            'departure_date' => 'required|date',
            'return_date' => 'required|date',
            'number_of_people' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid data provided',
                'errors' => $validator->errors()
            ], 422);
        }

        $packageDetail = packageDetail::create($request->all());

        return response()->json([
            'message' => 'Package Detail created successfully',
            'packageDetail' => $packageDetail
        ], 201);
    }

    public function destroy($id){
        $packageDetail = PackageDetail::find($id);
        if ($packageDetail) {
            $packageDetail->delete();
            return response()->json([
                'message' => 'Package Detail deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Package Detail not found'
            ], 404);
        }
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'origin_city' => 'required|string',
            'destination_city' => 'required|string',
            'departure_date' => 'required|date',
            'return_date' => 'required|date',
            'number_of_people' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid data provided',
                'errors' => $validator->errors()
            ], 422);
        }

        $packageDetail = PackageDetail::find($id);
        if ($packageDetail) {
            $packageDetail->update($request->all());
            return response()->json([
                'message' => 'Package Detail updated successfully',
                'packageDetail' => $packageDetail
            ], 200);
        } else {
            return response()->json([
                'message' => 'Package Detail not found'
            ], 404);
        }
    }
}
