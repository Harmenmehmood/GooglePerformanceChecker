<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class LighthouseController extends Controller
{
    public function checkPerformance(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'url' => 'required|url',
            'platform' => 'required|in:mobile,desktop',
        ]);

        $client = new Client();
        $platform = $validated['platform'] === 'mobile' ? 'mobile' : 'desktop';
        $url = $validated['url'];

        try {
            // Make the request to the Google PageSpeed API
            $response = $client->get("https://www.googleapis.com/pagespeedonline/v5/runPagespeed", [
                'query' => [
                    'url' => $url,
                    'strategy' => $platform,
                ]
            ]);

            // Decode the response and extract the performance score
            $body = json_decode($response->getBody(), true);
            $performanceScore = $body['lighthouseResult']['categories']['performance']['score'] * 100;

            return response()->json(['performance_score' => $performanceScore]);
        } catch (RequestException $e) {
            // If there is an error with the API request, handle it gracefully
            return response()->json([
                'error' => 'Unable to fetch performance score',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}



