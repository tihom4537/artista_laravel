<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Models\Order;

class CreateOrderController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getData( Request $request)
    {
        $amount= $request->amount;
        $endpoint = 'https://api.razorpay.com/v1/orders';
        $username = 'rzp_test_Hb4hFCm46361XC';
        $password = 'QXJiLk56a1KPl8HBOxAuKDB8';

        $data = [
            'amount' => $amount,
            'currency' => 'INR',
            'receipt' => 'rcptid_11',
            'partial_payment' => true,
            'first_payment_min_amount' => 23500,
        ];

        $response = $this->apiService->callApi($endpoint, 'POST', $data, $username, $password);

        // Check if the response is successful and contains the necessary fields
    if (isset($response['id']) && isset($response['amount'])) {
        // Pass relevant data to the store function
        return $this->store(new Request(['order_id' => $response['id'], 'amount' => $response['amount']]));
    }

        return response()->json($response);
    }

    public function store(Request $request)
    {
        // var_dump(Auth::user()->id);
        
        $booking=Order::create([
            // 'user_id'=>Auth::user()->id,
            'order_id'=>$request->order_id,
            'amount'=>$request->amount,
            // 'special_request'=>$request->special_request

        ]);

        return ($booking);
       }

}
