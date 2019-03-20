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
        $transactions = Transaction::with([
            'payment',
            'customer',
            'supplier', 
        ])->get()->toArray();
        return $transactions;
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
            'shipping_address' => 'required|string',
            'customer_id' => 'required|uuid|exists:customers,id',
            'supplier_id' => 'required|uuid|exists:suppliers,id',
        ]);

        $transaction = new Transaction([
            'total_price' => $data['total_price'],
            'status' => $data['status'],
            'shipping_address' => $data['shipping_address'],
            'customer_id' => $data['customer_id'],
            'supplier_id' => $data['supplier_id'],
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
        $transaction = Transaction::with([
            'payment',
            'customer',
            'supplier', 
        ])->where('id',$transaction->id)->get()->toArray();
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
            'supplier_id' => 'required|uuid|exists:suppliers,id',

        ]);

        $transaction->total_price = $data['total_price'];
        $transaction->status = $data['status'];
        $transaction->shipping_address = $data['shipping_address'];
        $transaction->customer_id = $data['customer_id'];
        $transaction->supplier_id = $data['supplier_id'];
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
