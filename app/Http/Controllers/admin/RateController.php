<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use App\Http\Requests\{StoreRateRequest, UpdateRateRequest};
use Yajra\DataTables\Facades\DataTables;

class RateController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:rate view')->only('index', 'show');
        $this->middleware('permission:rate create')->only('create', 'store');
        $this->middleware('permission:rate edit')->only('edit', 'update');
        $this->middleware('permission:rate delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $rates = Rate::with('user:id,name', 'sender:id');

            return DataTables::of($rates)
                ->addColumn('extra', function($row){
                    return str($row->extra)->limit(100);
                })
				->addColumn('request', function($row){
                    return str($row->request)->limit(100);
                })
				->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : '';
                })->addColumn('sender', function ($row) {
                    return $row->sender ? $row->sender->id : '';
                })->addColumn('action', 'rates.include.action')
                ->toJson();
        }

        return view('admin.rates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRateRequest $request)
    {
        
        Rate::create($request->validated());

        return redirect()
            ->route('rates.index')
            ->with('success', __('The rate was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show(Rate $rate)
    {
        $rate->load('user:id,name', 'sender:id');

		return view('admin.rates.show', compact('rate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function edit(Rate $rate)
    {
        $rate->load('user:id,name', 'sender:id');

		return view('admin.rates.edit', compact('rate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRateRequest $request, Rate $rate)
    {
        
        $rate->update($request->validated());

        return redirect()
            ->route('rates.index')
            ->with('success', __('The rate was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rate $rate)
    {
        try {
            $rate->delete();

            return redirect()
                ->route('rates.index')
                ->with('success', __('The rate was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('rates.index')
                ->with('error', __("The rate can't be deleted because it's related to another table."));
        }
    }
}
