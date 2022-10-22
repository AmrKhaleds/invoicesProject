<?php

namespace App\Http\Controllers;

use App\Models\factories;
use Illuminate\Http\Request;

class FactoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $factories = factories::all();
        return view('factories.index', compact('factories'));
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
        $this->validate($request ,[
            'factory_name' => 'required|unique:factories|max:255',
        ],[
            'factory_name.required' =>'يرجي ادخال اسم المصنع',
            'factory_name.unique' =>'اسم القسم مسجل مسبقا',
        ]);
    
            factories::create([  // 'inside database' => $request->from form
                'factory_name' => $request->factory_name,
                'description' => $request->description,
                'created_by' => (Auth()->user()->name),
            ]);
            session()->flash('Add', 'تم إضافة المنتج بنجاح');
            return redirect('/factories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\factories  $factories
     * @return \Illuminate\Http\Response
     */
    public function show(factories $factories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\factories  $factories
     * @return \Illuminate\Http\Response
     */
    public function edit(factories $factories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\factories  $factories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $this->validate($request, [
            'factory_name' => 'required|unique:factories|max:255'. $id,
        ],[
            'factory_name.required' =>'يرجي ادخال اسم المصنع',
            'factory_name.unique' =>'اسم القسم مسجل مسبقا',
        ]);
        $factories = factories::find($id);
        $factories->update([
            'factory_name' => $request->factory_name,
            'description' => $request->description,
        ]);
        session()->flash('Edit', 'تم تعديل القسم بنجاح');
        return redirect('/factories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\factories  $factories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        factories::find($id)->delete();
        session()->flash('delete', 'تم حذف المصنع بنجاح');
        return redirect('/factories');
    }
}
