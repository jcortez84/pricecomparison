<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alert;

class AlertsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'target_price' => 'required',
            'email' => 'required'
        ]);

        $alert = new Alert;

        $alert->product_id = $request->input('product_id');
        $alert->target_price = $request->input('target_price');
        $alert->email = $request->input('email');

        $alert->save();
        
        return redirect()->back()->with('success', 'Price Alert successfully set');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'target_price' => 'required',
            'email' => 'required'
        ]);

        $alert = Alert::find($id);

        $alert->product_id = $request->input('product_id');
        $alert->target_price = $request->input('target_price');
        $alert->email = $request->input('email');

        $alert->save();
        
        return redirect()->back()->with('success', 'Price Alert Successfully Updated');
    }
    
}
