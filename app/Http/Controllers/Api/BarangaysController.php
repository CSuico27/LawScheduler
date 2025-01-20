<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PHBarangays;
use Illuminate\Http\Request;

class BarangaysController extends Controller
{
    public function index(Request $request)
    {
        // $search = $request->input('search');
        // $selected = $request->input('selected');

        // if ($search) {
        //     $barangays = PHBarangays::where('barangay_description', 'like', '%' . $search . '%')->get();
        // } elseif ($selected) {
            
        //     $selectedBarangays = PHBarangays::whereIn('id', $selected)->get();
        //     return response()->json($selectedBarangays);
        // } else {
            
        //     $barangays = PHBarangays::all();
        // }

        // return response()->json($barangays);
    }
}
