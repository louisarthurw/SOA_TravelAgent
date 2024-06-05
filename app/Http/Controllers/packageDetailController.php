<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PackageDetail;
use App\Models\FlightDetail;
use App\Models\HotelDetail;
use App\Models\AttractionDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PackageDetailController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|exists:package,id',
            'day' => 'required|integer',
            'description' => 'required|string',
            'origin_city' => 'required|string',
            'destination_city' => 'required|string',
            'flight_details' => 'sometimes|array',
            'hotel_details' => 'sometimes|array',
            'attraction_details' => 'sometimes|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid data provided',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $packageDetail = packageDetail::create($request->only([
                'package_id', 'day', 'description', 'origin_city', 'destination_city',
            ]));

            if ($request->has('flight_details')) {
                $flightDetails = $request->flight_details;
            
                // If flight_details is a JSON string, decode it into an array
                if (is_string($flightDetails)) {
                    $flightDetails = json_decode($flightDetails, true);
                }
            
                // Ensure flightDetails is an array before proceeding
                if (is_array($flightDetails)) {
                    foreach ($flightDetails as $flight) {
                        // Ensure each flight is an array
                        if (is_array($flight)) {
                            $flight['package_details_id'] = $packageDetail->id;
                            flightDetail::create($flight);
                        }
                    }
                }
            }

            if ($request->has('hotel_details')) {
                $hotelDetails = $request->hotel_details;
            
                // If hotel_details is a JSON string, decode it into an array
                if (is_string($hotelDetails)) {
                    $hotelDetails = json_decode($hotelDetails, true);
                }
            
                // Ensure hotelDetails is an array before proceeding
                if (is_array($hotelDetails)) {
                    foreach ($hotelDetails as $hotel) {
                        // Ensure each hotel is an array
                        if (is_array($hotel)) {
                            $hotel['package_details_id'] = $packageDetail->id;
                            hotelDetail::create($hotel);
                        }
                    }
                }
            }

            if ($request->has('attraction_details')) {
                $attractionDetails = $request->attraction_details;
            
                // If attraction_details is a JSON string, decode it into an array
                if (is_string($attractionDetails)) {
                    $attractionDetails = json_decode($attractionDetails, true);
                }
            
                // Ensure attractionDetails is an array before proceeding
                if (is_array($attractionDetails)) {
                    foreach ($attractionDetails as $attraction) {
                        // Ensure each attraction is an array
                        if (is_array($attraction)) {
                            $attraction['package_details_id'] = $packageDetail->id;
                            attractionDetail::create($attraction);
                        }
                    }
                }
            }

            DB::commit();
            return response()->json([
                'message' => 'Package Detail created successfully',
                'packageDetail' => $packageDetail
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error creating Package Detail',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id){
        $packageDetail = packageDetail::find($id);
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
            'flight_details' => 'sometimes|array',
            'hotel_details' => 'sometimes|array',
            'attraction_details' => 'sometimes|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid data provided',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $packageDetail = packageDetail::find($id);
            if (!$packageDetail) {
                return response()->json([
                    'message' => 'Package Detail not found'
                ], 404);
            }

            $packageDetail->update($request->only([
                'description', 'origin_city', 'destination_city', 'departure_date', 'return_date', 'number_of_people'
            ]));

            if ($request->has('flight_details')) {
                $packageDetail->flightDetails()->delete();
                foreach ($request->flight_details as $flight) {
                    $flight['package_details_id'] = $packageDetail->id;
                    flightDetail::create($flight);
                }
            }

            if ($request->has('hotel_details')) {
                $packageDetail->hotelDetails()->delete();
                foreach ($request->hotel_details as $hotel) {
                    $hotel['package_details_id'] = $packageDetail->id;
                    hotelDetail::create($hotel);
                }
            }

            if ($request->has('attraction_details')) {
                $packageDetail->attractionDetails()->delete();
                foreach ($request->attraction_details as $attraction) {
                    $attraction['package_details_id'] = $packageDetail->id;
                    attractionDetail::create($attraction);
                }
            }

            DB::commit();
            return response()->json([
                'message' => 'Package Detail updated successfully',
                'packageDetail' => $packageDetail
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error updating Package Detail',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
