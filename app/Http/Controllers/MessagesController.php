<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Message;

class MessagesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shopfront.messages.create');
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
            'name' => 'required',
            'email' => 'required',
            'need' => 'required',
            'message' => 'required'
        ]);

        $message = new Message;
        $message->name = $request->input('name');
        $message->email = $request->input('email');
        $message->need = $request->input('need');
        $message->message = $request->input('message');
        $message->save();

        return redirect()->back()->with('success', 'Message sent successfully');
    }
}