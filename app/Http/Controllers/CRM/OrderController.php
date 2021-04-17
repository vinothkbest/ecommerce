<?php

namespace App\Http\Controllers\CRM;

use App\Models\Order;
use App\Models\Transaction;
use App\Exports\OrderExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where("admin_status", 0)->orderByDesc("updated_at")->get();
        $type="order";
        return view("admin.pages.orders.index", compact("orders", "type"));
    }

    public function update(Request $request, Order $order){

            $order->parcel_id = $request->parcel;
            $order->save();
            return redirect()->route("admin.orders.show", [$order])->with("success", "Parcel ID successfully assigned & tracking status given to user");
    }

    public function show(Order $order)
    {
        return view("admin.pages.orders.detail", compact("order"));
    }

    public function cancelOrder(Order $order){
        $order->admin_status = 1;
        $order->cancelled_date = Carbon::now();
        $order->save();
        return redirect()->back()->with("success", "Parcel ID successfully assigned & tracking status given to user");
    }
    public function cancelOrderRefund(Order $order){
        $transaction = Transaction::find($order->transaction_id);
        $transaction->is_refunded = 1;
        $transaction->save();
        return redirect()->back()->with("success", "Parcel ID successfully assigned & tracking status given to user");
    }
    public function cancelled()
    {
        $orders = Order::where("admin_status", 1)->orderByDesc("updated_at")->get();
        $type="cancel";
        return view("admin.pages.orders.index", compact("orders", "type"));
    }

    public function cancelShow(Order $order)
    {
        return view("admin.pages.orders.detail", compact("order"));
    }

    public function invoice(Order $order){

        $pdf = PDF::loadView('admin.pages.orders.invoice',
                compact('order'));
        return $pdf->stream($order->order_id.'_invoice.pdf');
    }
}
