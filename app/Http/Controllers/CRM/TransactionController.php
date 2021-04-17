<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions=Transaction::select('id', 'vendor_id', 'subscription_id', 'transaction_id', 'transaction_status', 'amount', 'validity', 'restriction', 'balance', 'purchase_date', 'expiry_date')->with('vendor', 'subscription')->get();
        return view('admin.pages.transactions.index', compact('transactions'));
    }
    public function show($id)
    {
        //return $transaction;
        return view('admin.pages.transactions.show');
    }
}