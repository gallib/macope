<?php

namespace App\Http\Controllers;

use App\Categorization;
use App\Category;
use App\Http\Requests\CategorizationRequest;

class CategorizationController extends Controller
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
        $categorizations = Categorization::get();

        return view('categorizations.index', compact(['categorizations']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get()->sortBy('name')->pluck('name_with_type_category', 'id');
        $categorization = new Categorization();

        return view('categorizations.create', compact(['categories', 'categorization']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategorizationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategorizationRequest $request)
    {
        $categorization = Categorization::create($request->all());

        return redirect()
            ->route('categorizations.index')
            ->with('flash', 'The categorization has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorization $categorization
     * @return \Illuminate\Http\Response
     */
    public function show(Categorization $categorization)
    {
        return view('categorizations.show', compact(['categorization']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorization $categorization
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorization $categorization)
    {
        $categories = Category::get()->sortBy('name')->pluck('name_with_type_category', 'id');
        $searchTypes = array_combine($categorization->getSearchTypes(), $categorization->getSearchTypes());
        $entryTypes = array_combine($categorization->getEntryTypes(), $categorization->getEntryTypes());

        return view('categorizations.edit', compact(['categorization', 'categories', 'searchTypes', 'entryTypes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategorizationRequest  $request
     * @param  \App\Categorization $categorization
     * @return \Illuminate\Http\Response
     */
    public function update(CategorizationRequest $request, Categorization $categorization)
    {
        $categorization->update($request->all());

        return redirect()
            ->route('categorizations.index')
            ->with('flash', 'The categorization has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorization $categorization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorization $categorization)
    {
        $categorization->delete();

        return redirect()
            ->route('categorizations.index')
            ->with('flash', 'The categorization has been deleted!');
    }
}
