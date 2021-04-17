<?php

namespace App\Http\Controllers\API\User;

use Responser;
use App\Models\Enquiry;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EnquiryController extends Controller
{
    public function getEnquiry(Request $request)
    {
        try {
            $user=$request->user();
            $enquiry=Enquiry::where('user_id', $user->id)->with(['product:id,name,brand_id','vendor:id,name'])->get();
            $data['enquiry']=$enquiry;
            return Responser::success('Enquiry successfully', $data);
        } catch (Exception $e) {
            return Responser::failed($e->getMessage());
        }
    }
    public function addEnquiry(Request $request)
    {
        $validatedData =  Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'description'=>'required|min:10:max:500'
        ]);

        if ($validatedData->fails()) {
            return Responser::failed($validatedData->errors()->first());
        }

        try {
            $user=$request->user();
            $user_id=$user->id;
            $product_id=$request->product_id;
            $product=Product::select('id', 'vendor_id')->find($product_id);
            $vendor_id=$product->vendor_id;
            $description=$request->description;

            $enquired=Enquiry::where('user_id', $user->id)->where('product_id', $product_id)->first();
            if ($enquired) {
                return Responser::failed('Enquiry already created', ['enquiry'=>$enquired]);
            }
            $enquiry=Enquiry::create(compact('user_id', 'product_id', 'vendor_id', 'description'));
            $data['enquiry']=$enquiry;
            return Responser::success('Enquiry Created successfully', $data);
        } catch (Exception $e) {
            return Responser::failed($e->getMessage());
        }
    }
}
