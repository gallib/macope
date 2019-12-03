<?php

namespace App\Http\Controllers;

use App\Account;
use App\Http\Requests\ImportFileRequest;
use App\Importer\ImportDataFactory;
use Carbon\Carbon;

class ImportFileController extends Controller
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
     * Show the import file form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::get();

        return view('import-file.index', compact('accounts'));
    }

    /**
     * import the given file.
     *
     * @param  \App\Http\Requests\ImportFileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function importFile(ImportFileRequest $request)
    {
        $file = $request->file('file');
        $date = Carbon::now();

        try {
            $filepath = $file->storeAs($date->format(config('macope.upload_folder')), $file->getClientOriginalName());

            $importer = ImportDataFactory::create($filepath);

            $importer->import();

            return redirect()
                ->route('import-file.index')
                ->with('flash', 'The file has been imported!');
        } catch (\Exception $e) {
            return redirect()
                ->route('import-file.index')
                ->withErrors(['file' => $e->getMessage()]);
        }
    }
}
