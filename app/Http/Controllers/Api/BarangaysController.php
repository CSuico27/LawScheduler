<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PHBarangays;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

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

    public function createMeeting()
    {
    try {
        // Generate the Zoom token
        $zoomTokenResponse = $this->generateToken();

        if ($zoomTokenResponse && isset($zoomTokenResponse['access_token'])) {
            $zoomToken = $zoomTokenResponse['access_token'];

            // Create the Zoom meeting
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $zoomToken,
                'Content-Type' => 'application/json',
            ])->post("https://api.zoom.us/v2/users/me/meetings", [
                'topic' => 'Meeting Topic', // Replace with your actual meeting title
                'type' => 2, // 2 for scheduled meeting
                'start_time' => now()->addHour()->toIso8601String(), // Example start time
                'duration' => 60, // Example duration in minutes
                "settings" => [
                    "host_video" => true,
                    "join_before_host"=> true,
                    "mute_upon_entry"=> true
                ]
            ]);

            // $response = Http::withHeaders([
            //     'Authorization' => 'Bearer ' . $zoomToken,
            //     // 'Content-Type' => 'application/x-www-form-urlencoded',
            // ])->get("https://api.zoom.us/v2/users/me");

            // Check for successful response
            if ($response->successful()) {
                // Handle the successful response
                return $response->json();
            } else {
                // Handle the failed response
                return response()->json(['error' => 'Failed to create Zoom meeting'], 500);
            }
        } else {
            return response()->json(['error' => 'Failed to generate Zoom token'], 500);
        }
        // return  $zoomTokenResponse->json();

    } catch (\Throwable $th) {
        // Log and handle the error
        return response()->json(['error' => $th->getMessage()], 500);
    }
}

    protected function generateToken()
    {
        try {
            $base64String = base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET'));
            $accountId = env('ZOOM_ACCOUNT_ID');

            $responseToken = Http::withHeaders([
                "Content-Type" => "application/x-www-form-urlencoded",
                "Authorization" => "Basic {$base64String}"
            ])->post("https://zoom.us/oauth/token?grant_type=account_credentials&account_id={$accountId}");

            // return $responseToken->json();
            return $responseToken;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
