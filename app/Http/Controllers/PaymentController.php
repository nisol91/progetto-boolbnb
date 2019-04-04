<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use Carbon\Carbon;


use Braintree_Transaction;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $url = $_SERVER['REQUEST_URI'];
        $id = substr($url, -2);

        $apartments = Apartment::all();

        return view('payment', compact('id', 'apartments'));
    }
    public function process(Request $request)
    {

        $payload = $request->input('payload', false);
        $pay = $request->input('pay');

        $nonce = $payload['nonce'];

        $status = Braintree_Transaction::sale([
          'amount' => $pay,
          'paymentMethodNonce' => $nonce,
          'options' => [
            'submitForSettlement' => true,
            ]
        ]);

        return response()->json($status);
    }

    public function ajaxRequestPay(Request $request)
    {
        $input = request()->all();

        $apartaments = Apartment::orderBy('id');

        $appartamento = $apartaments->where('id', $input['appartamento_id'])->first();

        $data = Carbon::now();

        if ($input['tempo'] == 24) {
        $appartamento->sponsor = 1;
        $appartamento->app_date = $data;

        $appartamento->save();
    } else if ($input['tempo'] == 72) {
        $appartamento->sponsor = 2;
        $appartamento->app_date = $data;

        $appartamento->save();
    } else if ($input['tempo'] == 144) {
        $appartamento->sponsor = 3;
        $appartamento->app_date = $data;

        $appartamento->save();
    }



            return response()->json([
                'input'=>$input,
                'apartments'=>$appartamento,
            ]);

    }
}
