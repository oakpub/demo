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

Route::get('table', function(){
    return view('table');
});

Route::post('table', function(Request $request) {
    $data = [];
    for ($i = 1; $i <= 200; $i++) {
        $data[] = ['id' => $i, 'name' => 'Name ' . $i, 'price' => 'Price ' . $i];
    }

    $data = array_slice($data, 0, 10);

    return ['total' => 200, 'page' => 1, 'rows' => $data];
});

Route::get('jqgrid', function(){
    return view('jqgrid');
});

Route::post('jqgrid', function(Request $request) {
    $rowsCount = 200;

    $page = $request->page ? $request->page : 1;
    $limit = $request->rows;
    $offset = ($page - 1) * $limit;

    $data = [];
    for ($i = 1; $i <= $rowsCount; $i++) {
        $data[] = ['id' => $i, 'name' => 'Name ' . $i, 'price' => 'Price ' . $i];
    }

    $data = array_slice($data, $offset, $limit);

    return ["page" => $page, "total" => 20, "records" => $rowsCount,"rows" => $data];
});

Route::get('tablesorter', function(){
    return view('tablesorter');
});