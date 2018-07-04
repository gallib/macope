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
        try {
            TypeCategory::create($request->all());

            return redirect()
                ->route('type-categories.index')
                ->withSuccess(['success' => 'The type category has been added']);
        } catch (\Exception $e) {
            return redirect()
                ->route('type-categories.create')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $typeCategory = TypeCategory::findOrFail($id);

        return view('type-categories.show', compact(['typeCategory']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $typeCategory = TypeCategory::findOrFail($id);

        return view('type-categories.edit', compact(['typeCategory']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TypeCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypeCategoryRequest $request, $id)
    {
        $typeCategory = TypeCategory::findOrFail($id);

        $typeCategory->update($request->all());

        return redirect()
                ->route('type-categories.index')
                ->withSuccess(['success' => 'The type category has been successfully updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $typeCategory = TypeCategory::findOrFail($id);

        if ($typeCategory->categories()->count() > 0) {
            throw new \Exception('The type category can\'t be deleted.');
        }

        $typeCategory->delete();

        return redirect()
                ->route('type-categories.index');
    }
}
