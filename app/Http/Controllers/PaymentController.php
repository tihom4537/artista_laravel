<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentDetail;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $info =PaymentDetail::create([ 

            'payment_id'=>$request->payment_id,
            'order_id'=>$request->order_id,
            'signature'=>$request->signature, 

        ]);
        return ($info);
    }
}
