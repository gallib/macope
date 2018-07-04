<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Account;
use App\Importer\ImportDataFactory;
use App\Http\Requests\ImportFileRequest;

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
            $importer = ImportDataFactory::create($file);
            $uploaded = $file->storeAs($date->format(config('macope.upload_folder')), $file->getClientOriginalName());

            $importer->import();

            return redirect()
                ->route('import-file.index')
                ->withSuccess(['success' => 'The file has been imported successfully']);
        } catch (\Exception $e) {
            return redirect()
                ->route('import-file.index')
                ->withErrors(['file' => $e->getMessage()]);
        }
    }
}
