<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Subscription;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events=Event::select('id', 'subscription_id', 'name', 'description', 'start_date', 'end_date', 'status')->with('subscription')->get();
        //return $events;
        return view('admin.pages.events.index', compact('events'));
    }

    public function create()
    {
        $subscriptions=Subscription::select('id', 'type', 'name', 'amount', 'description')->where('type', 'event')->latest()->get();
        //return $subscriptions;
        return view('admin.pages.events.create', compact('subscriptions'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'subscription_id'=>'required|exists:subscriptions,id',
            'name'=>'required',
            'start_date'=>'required|date_format:Y-m-d H:i|after:+10 day',
            'end_date'=>'required|date_format:Y-m-d H:i||after:start_date',
            'status'=>'required|in:0,1',
            'description'=>'required|min:10'
        ]);
        //return $request;
        Event::create($request->all());
        return redirect()->route('admin.events.index')->with(['status' => 'success', 'message' => 'Event created successfully']);
    }
    public function show(Event $event)
    {
        //
    }

    public function edit(Event $event)
    {
        $subscriptions=Subscription::select('id', 'type', 'name', 'amount', 'description')->where('type', 'event')->latest()->get();
        return view('admin.pages.events.edit', compact('subscriptions', 'event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->validate($request, [
            'subscription_id'=>'required|exists:subscriptions,id',
            'name'=>'required',
            'start_date'=>'required|date_format:Y-m-d H:i|after:+10 day',
            'end_date'=>'required|date_format:Y-m-d H:i||after:start_date',
            'status'=>'required|in:0,1',
            'description'=>'required|min:10'
        ]);
        //return $request;
        $event->update($request->all());
        return redirect()->route('admin.events.index')->with(['status' => 'success', 'message' => 'Event Updated successfully']);
    }

    public function destroy(Event $event)
    {
        //
    }

    public function status(Event $event)
    {
        $event->status=!$event->status;
        $event->save();
        if ($event->status) {
            return redirect()->route('admin.events.index')->with(['status'=>'success','message'=>'Event activated']);
        } else {
            return redirect()->route('admin.events.index')->with(['status'=>'success','message'=>'Event deactivated']);
        }
    }
}
