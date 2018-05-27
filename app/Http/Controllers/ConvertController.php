<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use File;

class ConvertController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Data Array
        $data = [];

        // Return to View
        return view('convert', $data);
    }

    public function post(Request $request)
    {
        // Get Variable File
        $file = $request->file('file');

        // Get Original Filename
        $prefix_date_name = date('YmdHis');
        $prefix_path_url = 'src/uploads/';
        $filename = $prefix_date_name.'_'.$file->getClientOriginalName();

        // Upload File to System
        $file->move(public_path($prefix_path_url), $filename);

        // Get File from system to read
        $contents = File::get(public_path('src/uploads/'.$filename));

        // Process sort file
        $contents = explode("\n", $contents);
        sort($contents);

        // Create file has sorted
        $contents = implode("\r\n", $contents);

        // Upload File sorted to System
        $filename = $prefix_date_name.'_sorted_'.'city_test.txt';
        File::put(public_path($prefix_path_url.$filename), $contents);

        // Download file sorted
        $file = public_path().'/'.$prefix_path_url.$filename;
        return response()->download($file);
    }
}
