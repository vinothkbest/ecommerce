<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions=Transaction::select('id', 'vendor_id', 'subscription_id', 'transaction_id', 'transaction_status', 'amount', 'validity', 'restriction', 'balance', 'purchase_date', 'expiry_date')
        ->where('vendor_id', Auth::guard('vendor')->id())->with('subscription')->get();
        //return $transactions;
        return view('vendor.pages.transactions.index', compact('transactions'));
    }
    public function show(Transaction $transaction)
    {
        //return $transaction;
        return view('vendor.pages.transactions.show', compact('transaction'));
    }
}
