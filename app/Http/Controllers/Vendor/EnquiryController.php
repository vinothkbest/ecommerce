<?php

namespace App\Http\Controllers\Vendor;

use App\Models\User;
use App\Models\Vendor;
use App\Models\Enquiry;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\EnquiryExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $rows=$request->rows??10;
        $search=$request->search;
        $enquiries=Enquiry::where('vendor_id', Auth::id())
        ->when($request->search,fn($query,$search)=>$query->where(fn($query)=>$query->where('description','like',"%$search%")->orWhereHas('user',fn($query)=>$query->where('name','like',"%$search%")->orWhere('mobile_number','like',"%$search%"))->orWhereHas('user',fn($query)=>$query->where('email','like',"%$search%"))->orWhereHas('product',fn($query)=>$query->where('name','like',"%$search%"))))->when($request->vendor_id,fn($query,$branch) => $query->whereHas('vendor',fn($query)=>$query->where('id',$request->vendor_id)))
        ->when($request->f_date,fn($query,$f_date)=>$query->whereDate('created_at','>=',$f_date))
        ->when($request->t_date,fn($query,$t_date)=>$query->whereDate('created_at','<=',$t_date))
        ->whereNotIn('status', [0]);
        //return $enquiries;
        $model=Enquiry::class;
        if($request->export=='Export' &&  $enquiries->count()>0)
            return Excel::download(new EnquiryExport($enquiries->get()), 'Enquiries.xlsx');
        elseif($request->export=='Export')
            return redirect()->back()->with('status','error')->with('message','No record found to export');
        else
            return view('vendor.pages.enquiries.index',['enquiries'=>$enquiries->paginate($rows),'model'=>$model]);

    }


    public function status(Enquiry $enquiry)
    {
        $status=$enquiry->status;
        $enquiry->status=$status==1?2:($status==2?1:0);
        $enquiry->save();
        if ($enquiry->status==1) {
            return redirect()->route('vendor.enquiries.index')->with(['status'=>'success','message'=>'Enquiry changed to unreaded']);
        } else {
            return redirect()->route('vendor.enquiries.index')->with(['status'=>'success','message'=>'Enquiry changed to readed']);
        }
    }
}
