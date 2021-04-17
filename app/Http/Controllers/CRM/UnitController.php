<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Unit;
use Str;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::get();

        return view('admin.pages.units.index', compact('units'));
    }

    public function store(Request $request)
    {
       $validator = Validator::make($request->all(),[
                                    'unit' => 'unique:units,unit_name',
                                ], ['unique' => 'Unit has been already used']);
       if($validator->fails()){
            return redirect()->route('admin.units.index')->with('error', $validator->errors()->first());
       }
       
       Unit::create(['unit_name' => $request->unit, 'slug' => Str::slug($request->unit,'-')]);

       return redirect()->route('admin.units.index')->with('success', 'Unit is created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Unit::where('id', $id)->update(['unit_name' => $request->unit, 'slug' => Str::slug($request->unit,'-')]);
        return redirect()->route('admin.units.index')->with('success', 'Unit is updated successfully');
    }
}
