<?php

namespace Gallib\Macope\Http\Controllers;

use Gallib\Macope\Category;
use Gallib\Macope\TypeCategory;
use App\Http\Controllers\Controller;
use Gallib\Macope\Http\Requests\CategoryRequest;

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

        return view('macope::categories.index', compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeCategories = TypeCategory::pluck('name', 'id')->all();

        return view('macope::categories.create', compact(['typeCategories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Gallib\Macope\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->all());

        return redirect()
            ->route('categories.index')
            ->withSuccess(['success' => 'The category has been added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('macope::categories.show', compact(['category']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $typeCategories = TypeCategory::pluck('name', 'id')->all();

        return view('macope::categories.edit', compact(['category', 'typeCategories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Gallib\Macope\Http\Requests\CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->update($request->all());

        return redirect()
                ->route('categories.index')
                ->withSuccess(['success' => 'The category has been successfully updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->journalEntries()->count() > 0) {
            throw new \Exception('The category can\'t be deleted.');
        }

        $category->delete();

        return redirect()
                ->route('categories.index');
    }
}
