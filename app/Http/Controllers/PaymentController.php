<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();
        return response()->json($payments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();

        $request->validate([
            'payment_method' => 'required|string',
            'total_price' => 'required|numeric',
            'payment_date' => 'required|date',
            'transaction_id' => 'required|uuid|exists:transactions,id',
        ]);

        $payment = new Payment([
            'payment_method' => $data['payment_method'],
            'total_price' => $data['total_price'],
            'payment_date' => $data['payment_date'],
            'transaction_id' => $data['transaction_id'],
        ]);
        $payment->save();

        return $payment;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return $payment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $data = $request->json()->all();

        $request->validate([
            'payment_method' => 'required|string',
            'total_price' => 'required|numeric',
            'payment_date' => 'required|date',
            'transaction_id' => 'required|uuid|exists:transactions,id',
        ]);

        $payment->payment_method = $data['payment_method'];
        $payment->total_price = $data['total_price'];
        $payment->payment_date = $data['payment_date'];
        $payment->transaction_id = $data['transaction_id'];
        $payment->save();

        return $payment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return "Deleted";
    }
}
