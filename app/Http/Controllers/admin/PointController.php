<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Http\Requests\{StorePointRequest, UpdatePointRequest};
use Yajra\DataTables\Facades\DataTables;

class PointController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:point view')->only('index', 'show');
        $this->middleware('permission:point create')->only('create', 'store');
        $this->middleware('permission:point edit')->only('edit', 'update');
        $this->middleware('permission:point delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $points = Point::with('stander:id,name', 'rate:id,user_id');

            return DataTables::of($points)
                ->addColumn('stander', function ($row) {
                    return $row->stander ? $row->stander->name : '';
                })->addColumn('rate', function ($row) {
                    return $row->rate ? $row->rate->user_id : '';
                })->addColumn('action', 'points.include.action')
                ->toJson();
        }

        return view('admin.points.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.points.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePointRequest $request)
    {
        
        Point::create($request->validated());

        return redirect()
            ->route('points.index')
            ->with('success', __('The point was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function show(Point $point)
    {
        $point->load('stander:id,name', 'rate:id,user_id');

		return view('admin.points.show', compact('point'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function edit(Point $point)
    {
        $point->load('stander:id,name', 'rate:id,user_id');

		return view('admin.points.edit', compact('point'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePointRequest $request, Point $point)
    {
        
        $point->update($request->validated());

        return redirect()
            ->route('points.index')
            ->with('success', __('The point was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function destroy(Point $point)
    {
        try {
            $point->delete();

            return redirect()
                ->route('points.index')
                ->with('success', __('The point was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('points.index')
                ->with('error', __("The point can't be deleted because it's related to another table."));
        }
    }
}
