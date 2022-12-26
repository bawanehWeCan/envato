<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stander;
use App\Http\Requests\{StoreStanderRequest, UpdateStanderRequest};
use Yajra\DataTables\Facades\DataTables;

class StanderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:stander view')->only('index', 'show');
        $this->middleware('permission:stander create')->only('create', 'store');
        $this->middleware('permission:stander edit')->only('edit', 'update');
        $this->middleware('permission:stander delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $standers = Stander::query();

            return DataTables::of($standers)
                ->addColumn('action', 'standers.include.action')
                ->toJson();
        }

        return view('admin.standers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.standers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStanderRequest $request)
    {
        
        Stander::create($request->validated());

        return redirect()
            ->route('standers.index')
            ->with('success', __('The stander was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stander  $stander
     * @return \Illuminate\Http\Response
     */
    public function show(Stander $stander)
    {
        return view('admin.standers.show', compact('stander'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stander  $stander
     * @return \Illuminate\Http\Response
     */
    public function edit(Stander $stander)
    {
        return view('admin.standers.edit', compact('stander'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stander  $stander
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStanderRequest $request, Stander $stander)
    {
        
        $stander->update($request->validated());

        return redirect()
            ->route('standers.index')
            ->with('success', __('The stander was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stander  $stander
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stander $stander)
    {
        try {
            $stander->delete();

            return redirect()
                ->route('standers.index')
                ->with('success', __('The stander was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('standers.index')
                ->with('error', __("The stander can't be deleted because it's related to another table."));
        }
    }
}
