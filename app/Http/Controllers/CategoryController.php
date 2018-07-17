<?php

namespace App\Http\Controllers;

use App\Category;
use App\TypeCategory;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
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
        $categories = Category::withCount('journalEntries')->get();

        return view('categories.index', compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeCategories = TypeCategory::pluck('name', 'id')->all();

        return view('categories.create', compact(['typeCategories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->all());

        return redirect()
            ->route('categories.index')
            ->with('flash', 'The category has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show', compact(['category']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $typeCategories = TypeCategory::pluck('name', 'id')->all();

        return view('categories.edit', compact(['category', 'typeCategories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return redirect()
            ->route('categories.index')
            ->with('flash', 'The category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category = Category::findOrFail($id);

        if ($category->journalEntries()->count() > 0) {
            throw new \Exception('The category can\'t be deleted.');
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('flash', 'The category has been deleted!');
    }
}
