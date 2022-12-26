<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Http\Requests\{StoreCommentRequest, UpdateCommentRequest};
use Yajra\DataTables\Facades\DataTables;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:comment view')->only('index', 'show');
        $this->middleware('permission:comment create')->only('create', 'store');
        $this->middleware('permission:comment edit')->only('edit', 'update');
        $this->middleware('permission:comment delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $comments = Comment::with('user:id,name', 'rate:id,user_id');

            return DataTables::of($comments)
                ->addColumn('comment', function($row){
                    return str($row->comment)->limit(100);
                })
				->addColumn('user', function ($row) {
                    return $row->user ? $row->user->name : '';
                })->addColumn('rate', function ($row) {
                    return $row->rate ? $row->rate->user_id : '';
                })->addColumn('action', 'comments.include.action')
                ->toJson();
        }

        return view('admin.comments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        
        Comment::create($request->validated());

        return redirect()
            ->route('comments.index')
            ->with('success', __('The comment was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        $comment->load('user:id,name', 'rate:id,user_id');

		return view('admin.comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        $comment->load('user:id,name', 'rate:id,user_id');

		return view('admin.comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        
        $comment->update($request->validated());

        return redirect()
            ->route('comments.index')
            ->with('success', __('The comment was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();

            return redirect()
                ->route('comments.index')
                ->with('success', __('The comment was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('comments.index')
                ->with('error', __("The comment can't be deleted because it's related to another table."));
        }
    }
}
