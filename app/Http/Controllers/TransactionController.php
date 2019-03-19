<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();
        return response()->json($transactions);
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
            'total_price' => 'required|numeric',
            'status' => 'required|boolean',
            'customer_id' => 'required|uuid|exists:customers,id',
        ]);

        $transaction = new Transaction([
            'total_price' => $data['total_price'],
            'status' => $data['status'],
            'customer_id' => $data['customer_id'],
        ]);
        $transaction->save();

        return $transaction;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return $transaction;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->json()->all();
        
        $request->validate([
            'total_price' => 'required|numeric',
            'status' => 'required|boolean',
            'customer_id' => 'required|uuid|exists:customers,id',
        ]);

        $transaction->total_price = $data['total_price'];
        $transaction->status = $data['status'];
        $transaction->customer_id = $data['customer_id'];
        $transaction->save();

        return $transaction;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return $transaction;
    }
}
