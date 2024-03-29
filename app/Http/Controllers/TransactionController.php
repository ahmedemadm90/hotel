<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Transactions|Transaction Create|Transaction Edit|Transaction Delete|Transaction Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Transaction Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Transaction Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Transaction Delete', ['only' => ['destroy']]);
        $this->middleware('permission:Transaction Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
    public function safe($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->update([
                'state'=>'safe',
            ]);
        }
        return back()->with(['success'=>'Transfeered Successfully']);
    }
}
