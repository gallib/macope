<?php

namespace Gallib\Macope\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Gallib\Macope\App\Importer\ImportDataFactory;
use Gallib\Macope\App\Http\Requests\ImportFileRequest;

class ImportFileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the import file form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('macope::import-file.index');
    }

    /**
     * import the given file.
     *
     * @param  \Gallib\Macope\App\Http\Requests\ImportFileRequest  $request
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
                ->route('importFile')
                ->withSuccess(['success' => 'The file has been imported successfully']);
        } catch (\Exception $e) {
            return redirect()
                ->route('importFile')
                ->withErrors(['file' => $e->getMessage()]);
        }
    }
}
