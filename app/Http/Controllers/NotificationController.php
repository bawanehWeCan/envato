<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Models\Notification;
use App\Models\Rate;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Auth::user()->notifications();
        return view('user.notifications')->with('notes',$notes);
    }

    public function count()
    {
        $notes = Notification::where('user_id',Auth::id())->where('read', '0')->get();

        return response()->json(count($notes));
        
    }


    public function whois(Request $request)
    {
        
        $rate = Rate::find($request->id);
        $rate->request = 'yes';
        $rate->save();

        $n = new Notification();
        $n->rate_id = $rate->id;
        $n->user_id = $rate->by_id;
        $n->by_id = Auth::id();
        $n->anonymous = '0';
        $n->read = '0';
        $n->type = '2';
        $n->save();

        return response()->json('تم ارسال الطلب');
        
    }

    public function approvewhois(Request $request)
    {
        
        $note = Notification::find($request->id);
        $note->approve = '1';
        $note->save();

        
        $rate = Rate::find($note->rate_id);
        $rate->request = 'acepet';
        $rate->anonymous = '0';
        $rate->save();

        $n = new Notification();
        $n->rate_id = $rate->id;
        $n->user_id = $rate->user_id;
        $n->by_id = Auth::id();
        $n->anonymous = '0';
        $n->read = '0';
        $n->approve = '0';
        $n->type = '3';
        $n->save();

        return response()->json('تم ارسال الطلب');
        
    }

    public function cancelwhois(Request $request)
    {
        
        $note = Notification::find($request->id);
        $note->approve = '3';
        $note->save();

        
        $rate = Rate::find($note->rate_id);
        $rate->request = 'no';
        $rate->save();

        $n = new Notification();
        $n->rate_id = $rate->id;
        $n->user_id = $rate->user_id;
        $n->by_id = Auth::id();
        $n->anonymous = '1';
        $n->read = '0';
        $n->approve = '0';
        $n->type = '4';
        $n->save();

        return response()->json('تم ارسال الطلب');
        
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
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
