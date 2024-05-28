<?php

namespace App\Http\Controllers;

use App\Models\package;
use Illuminate\Http\Request;

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
}
