<?php

namespace App\Http\Controllers\CRM;

use App\Models\User;
use App\Models\Vendor;
use App\Models\Enquiry;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Exports\EnquiryExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $rows=$request->rows??10;
        $search=$request->search;
        $enquiries=Enquiry::when($request->search,fn($query,$search)=>$query->where(fn($query)=>$query->where('description','like',"%$search%")->orWhereHas('user',fn($query)=>$query->where('email','like',"%$search%")->orWhere('mobile_number','like',"%$search%"))->orWhereHas('vendor',fn($query)=>$query->where('shop_name','like',"%$search%"))->orWhereHas('user',fn($query)=>$query->where('email','like',"%$search%"))->orWhereHas('product',fn($query)=>$query->where('name','like',"%$search%"))))->when($request->vendor_id,fn($query,$branch) => $query->whereHas('vendor',fn($query)=>$query->where('id',$request->vendor_id)))
        ->when($request->f_date,fn($query,$f_date)=>$query->whereDate('created_at','>=',$f_date))
        ->when($request->t_date,fn($query,$t_date)=>$query->whereDate('created_at','<=',$t_date));

        $model=Enquiry::class;

        $vendors = Vendor::whereStatus(1)->get();
        if($request->export=='Export' &&  $enquiries->count()>0)
            return Excel::download(new EnquiryExport($enquiries->get()), 'Enquiries.xlsx');
        elseif($request->export=='Export')
           return redirect()->back()->with('status','error')->with('message','No record found to export');
        else
            return view('admin.pages.enquiries.index',['enquiries'=>$enquiries->paginate($rows),'model'=>$model,'vendors'=>$vendors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::get();
        $products=Product::get();

        return view('admin.pages.enquiries.create', compact('users', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        //return $req;
        $this->validate($req, [
            'user_id'=>'required|exists:users,id',
            'product_id'=>'required|exists:products,id',
            'status'=>'required',
            'description'=>'required|min:50'
        ]);
        $enquiry=new Enquiry;

        $product=Product::select('vendor_id')->where('id', $req->product_id)->first();
        $data=$req->only('user_id', 'product_id', 'status', 'description');
        $data['vendor_id']=$product->vendor_id;
        $enquiry->create($data);
        return redirect()->route('admin.enquiries.index')->with(['status'=>'success','message'=>'Enquiry created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Enquiry $enquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquiry $enquiry)
    {
        $users=User::get();
        $products=Product::get();
        return view('admin.pages.enquiries.edit', compact('users', 'products', 'enquiry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Enquiry $enquiry)
    {
        $this->validate($req, [
            'user_id'=>'required|exists:users,id',
            'product_id'=>'required|exists:products,id',
            'status'=>'required',
            'description'=>'required|min:50'
        ]);
        $product=Product::select('vendor_id')->where('id', $req->product_id)->first();
        $data=$req->only('user_id', 'product_id', 'status', 'description');
        $data['vendor_id']=$product->vendor_id;
        $enquiry->update($data);
        return redirect()->route('admin.enquiries.index')->with(['status'=>'success','message'=>'Enquiry updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquiry $enquiry)
    {
        //
    }
    public function status(Enquiry $enquiry)
    {
        $status=$enquiry->status;
        $enquiry->status=$status==0?1:($status==1?2:0);
        $enquiry->save();
        if ($enquiry->status) {
            return redirect()->route('admin.enquiries.index')->with(['status'=>'success','message'=>'Enquiry activated']);
        } else {
            return redirect()->route('admin.enquiries.index')->with(['status'=>'success','message'=>'Enquiry deactivated']);
        }
    }
}
