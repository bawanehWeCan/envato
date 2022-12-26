<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Stander;
use App\Models\Rate;
use App\Models\Point;
use Auth;
use App\Models\Notification;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($username)
    {
        $user = User::where('username', '=', $username)->firstOrFail();
        $standers = Stander::all();
        return view('rate.add',['user'=>$user,'standers'=>$standers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $u = User::find($request->user_id);

        if( Auth::id() == $u->id ){
            return redirect('/u/'.$u->username)->with('warning', 'لا يمكنك تقيمم نفسك  !!'); 
        }
        $points = 0 ;
        foreach($request->standers as $stander){
            $points +=$stander['points'];

        }
        $avg = $points / count($request->standers);
        

        $rate = new Rate();
        $rate->user_id = $request->user_id;
        $anonymous =0;
        if(isset($request->anonymous)){
            $anonymous = 1 ;
        }
        $rate->anonymous = $anonymous;
        $rate->extra = $request->extra;
        $rate->avg = $avg;
        $rate->by_id = Auth::id();
        $rate->save();

        foreach($request->standers as $stander){
            $point = new Point;
            $point->stander = $stander['name'];
            $point->points = $stander['points'];
            $point->rate_id = $rate->id;
            $point->save();
            

        }

        $n = new Notification();
        $n->rate_id = $rate->id;
        $n->user_id = $request->user_id;
        $n->by_id = Auth::id();
        $n->anonymous = $anonymous;
        $n->read = '0';
        $n->approve = '0';
        $n->type = '1';
        $n->save();

        
        return redirect('/u/'.$u->username)->with('success', 'تم اضافه التقيم  !!');   

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rate = Rate::find($id);
        $user = User::find($rate->user_id);

        return view('rate.view',['user'=>$user,'rate'=>$rate]);
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
