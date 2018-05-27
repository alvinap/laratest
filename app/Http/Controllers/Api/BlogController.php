<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use DB;

class BlogController extends Controller 
{
    public function index()
    {
        // Data Array
        $data = [];

        // Get Data
        $blog = DB::table('blogs')->get();

        // Parsing to Data Array
        $data['blog'] = $blog;

        // Return to View
        return response(["data" => $data], 200)->header('Content-Type', 'application/json');
    }

    public function get(Request $request)
    {
        // Data Array
        $data = [];

        // Check Validate Request
        $this->validate($request, [
            'id' => 'required',
        ]);

        // Define Variable Request
        $id = $request->input('id');

        // Get Data
        $blog = DB::table('blogs')->where('id', $id)->get();

        // Parsing to Data Array
        $data['blog'] = $blog;

        // Return to View
        return response(["data" => $data], 200)->header('Content-Type', 'application/json');
    }

    public function post(Request $request)
    {
        // Data Array
        $data = [];
        $message = 'Error';

        // Check Validate Request
        $this->validate($request, [
            'title' => 'required',
            'text' => 'required',
        ]);

        // Define Variable Request
        $id = $request->input('id');
        $title = $request->input('title');
        $text = $request->input('text');
        $current_date = date('Y-m-d H:i:s');

        // Create Array to Post
        $post = [];
        $post['title'] = $title;
        $post['text'] = $text;
        $post['updated_at'] = $current_date;

        // Process Query
        if (!$id) {
            // Insert
            $post['created_at'] = $current_date;
            DB::table('blogs')
                ->insert($post);
            $message = 'Success';
        } else {
            // Update
            DB::table('blogs')
                ->where('id', $id)
                ->update($post);
            $message = 'Success';
        }

        // Parsing to Data Array
        $data['message'] = $message;

        // Return to View
        return response(["data" => $data], 200)->header('Content-Type', 'application/json');
    }

    public function delete(Request $request)
    {
        // Data Array
        $data = [];
        $message = 'Error';

        // Check Validate Request
        $this->validate($request, [
            'id' => 'required',
        ]);

        // Define Variable Request
        $id = $request->input('id');

        // Process Query
        if ($id) {
            // Delete
            DB::table('blogs')
                ->where('id', $id)
                ->delete();
            $message = 'Success';
        }

        // Parsing to Data Array
        $data['message'] = $message;

        // Return to View
        return response(["data" => $data], 200)->header('Content-Type', 'application/json');
    }
}
