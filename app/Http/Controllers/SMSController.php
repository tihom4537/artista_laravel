<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SMSController extends Controller
{
    public function SMS(Request $request)
    {
        // Replace 'YOUR_API_KEY' with your actual Fast2SMS API Key
        $apiKey = 'MhWCaEPDK6v1U7BtpOgkbRnlNrL8HucXjQw2TmiGJdY5z0I43sRh0kPpSEvt54TnmGVfUgKNoi86sFy9';

        // Prepare data to be sent in the POST request
        $data = [
            'variables_values' => $request->otp,
            'route' => 'otp',
            'numbers' => $request->numbers,
        ];

        // Initialize Guzzle client
        $client = new Client([
            'base_uri' => 'https://www.fast2sms.com/dev/',
            'headers' => [
                'authorization' => $apiKey,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ]
        ]);

        // Make the POST request to Fast2SMS API
        try {
            $response = $client->request('POST', 'bulkV2', [
                'form_params' => $data
            ]);

            $responseData = json_decode($response->getBody(), true);

            // Check if SMS was sent successfully
            if ($responseData['return']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Message sent successfully',
                    'request_id' => $responseData['request_id']
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send message'
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to make API request: ' . $e->getMessage()
            ], 500);
        }
    }
}
