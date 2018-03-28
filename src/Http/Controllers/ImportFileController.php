<?php

namespace Gallib\Macope\Http\Controllers;

use Carbon\Carbon;
use Gallib\Macope\Account;
use App\Http\Controllers\Controller;
use Gallib\Macope\Importer\ImportDataFactory;
use Gallib\Macope\Http\Requests\ImportFileRequest;

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

        return view('macope::import-file.index', compact('accounts'));
    }

    /**
     * import the given file.
     *
     * @param  \Gallib\Macope\Http\Requests\ImportFileRequest  $request
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
