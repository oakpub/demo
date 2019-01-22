<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('upload', ['started' => 0]);
});

Route::post('/', function (Request $request) {
    if ($request->hasFile('file') && in_array($request->file('file')->getClientOriginalExtension(), ['xls', 'xlsx'])) {
        $path = $request->file('file')->store('');
        $fullPath = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() . $path;

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fullPath);
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestRow();

        return view('upload', ['started' => 1, 'rows' => $highestRow, 'file' => $path]);
    } elseif ($request->limit) {
        $offset = $request->offset;
        $limit = $request->limit;
        $fileName = $request->file;

        $fullPath = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() . $fileName;
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fullPath);
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestRow();

        //здесь берем блок данных согласно offset и limit, записываем в базу

        $lastRow = $offset + $limit - 1;
        if ($highestRow < $lastRow) $lastRow = $highestRow;

        $percent = round($lastRow / $highestRow * 100, 2);

        return ['result' => 'ok', 'row' => $lastRow, 'percent' => $percent];
    }

    return 'По-видимому неподдерживаемый тип файла';
});
