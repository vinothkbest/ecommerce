<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions=Subscription::get();
        return view('admin.pages.subscriptions.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.subscriptions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'type'=>'in:basic,event',
            'name' => 'required|max:50',
            'validity'=>'required|numeric|min:1',
            'amount'=>'required|numeric|min:1',
            'image_count'=>'required|numeric|min:1',
            'status'=>'required|in:1,0',
            'description'=>'required|min:10,max:1000'
        ]);
        $subscription=new Subscription;
        $data=$request->except('image_count');
        $res=[
        ['type'=>'image','upload_count'=>$request->image_count]
        ];
        $data['restriction']=$res;
        $subscription->create($data);
        return redirect()->route('admin.subscriptions.index')
                        ->with('success', 'Subscription created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //return $subscription;
        return view('admin.pages.subscriptions.edit', compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        $this->validate($request, [
            'type'=>'in:basic,event',
            'name' => 'required|max:50',
            'validity'=>'required|numeric|min:1',
            'amount'=>'required|numeric|min:1',
            'image_count'=>'required|numeric|min:1',
            'status'=>'required|in:1,0',
            'description'=>'required|min:10,max:1000'
        ]);
        $data=$request->except('image_count');
        $res=[
        ['type'=>'image','upload_count'=>$request->image_count]
        ];
        $data['restriction']=$res;
        //return $data;
        $subscription->update($data);
        return redirect()->route('admin.subscriptions.index')
                        ->with('success', 'Subscription updated successfully');
    }

    public function destroy(Subscription $subscription)
    {
        //
    }

    public function status(Subscription $subscription)
    {
        $subscription->status=!$subscription->status;
        $subscription->save();
        if ($subscription->status) {
            return redirect()->route('admin.subscriptions.index')->with(['status'=>'success','message'=>'Subscription activated']);
        } else {
            return redirect()->route('admin.subscriptions.index')->with(['status'=>'success','message'=>'Subscription deactivated']);
        }
    }
}
