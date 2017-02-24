<?php

namespace Gallib\Macope\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Gallib\Macope\App\Categorization;
use Gallib\Macope\App\Category;
use Gallib\Macope\App\Http\Requests\CategorizationRequest;

class CategorizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorizations = Categorization::with('category')->get();

        return view('macope::categorizations.index', compact(['categorizations']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        $types      = (new Categorization())->getTypes();
        $types      = array_combine($types, $types);

        return view('macope::categorizations.create', compact(['categories', 'types']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Gallib\Macope\App\Http\Requests\CategorizationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategorizationRequest $request)
    {
        Categorization::create($request->all());

        return redirect()
            ->route('categorizations.index')
            ->withSuccess(['success' => 'The categorization has been added']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorization = Categorization::findOrFail($id);

        return view('macope::categorizations.show', compact(['categorization']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorization = Categorization::findOrFail($id);
        $categories     = Category::pluck('name', 'id')->all();
        $types          = (new Categorization())->getTypes();
        $types          = array_combine($types, $types);

        return view('macope::categorizations.edit', compact(['categorization', 'categories', 'types']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Gallib\Macope\App\Http\Requests\CategorizationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategorizationRequest $request, $id)
    {
        $categorization = Categorization::findOrFail($id);

        $categorization->update($request->all());

        return redirect()
                ->route('categorizations.index')
                ->withSuccess(['success' => 'The categorization has been successfully updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorization = Categorization::findOrFail($id);

        $categorization->delete();

        return redirect()
                ->route('categorizations.index');
    }
}
