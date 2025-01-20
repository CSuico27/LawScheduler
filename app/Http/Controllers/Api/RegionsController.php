<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PHRegions;
use Illuminate\Http\Request;

class RegionsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $selected = $request->input('selected');

        if ($search) {
            $regions = PHRegions::where('region_description', 'like', '%' . $search . '%')->get();
        } elseif ($selected) {
            
            $selectedRegions = PHRegions::whereIn('id', $selected)->get();
            return response()->json($selectedRegions);
        } else {
            
            $regions = PHRegions::all();
        }

        return response()->json($regions);
    }
}
