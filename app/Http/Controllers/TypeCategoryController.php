<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeCategoryRequest;
use App\TypeCategory;

class TypeCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeCategories = TypeCategory::all();

        return view('type-categories.index', compact(['typeCategories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('type-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TypeCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeCategoryRequest $request)
    {
        TypeCategory::create($request->all());

        return redirect()
            ->route('type-categories.index')
            ->with('flash', 'The type category has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeCategory $typeCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TypeCategory $typeCategory)
    {
        return view('type-categories.show', compact(['typeCategory']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeCategory $typeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeCategory $typeCategory)
    {
        return view('type-categories.edit', compact(['typeCategory']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TypeCategoryRequest  $request
     * @param  \App\TypeCategory $typeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(TypeCategoryRequest $request, TypeCategory $typeCategory)
    {
        $typeCategory->update($request->all());

        return redirect()
            ->route('type-categories.index')
            ->with('flash', 'The type category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeCategory $typeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeCategory $typeCategory)
    {
        if ($typeCategory->categories()->count() > 0) {
            throw new \Exception('The type category can\'t be deleted.');
        }

        $typeCategory->delete();

        return redirect()
            ->route('type-categories.index')
            ->with('flash', 'The type category has been deleted!');
    }
}
