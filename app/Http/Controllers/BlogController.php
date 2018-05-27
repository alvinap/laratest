<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Data Array
        $data = [];

        // Get Data
        $blog = DB::table('blogs')->get();

        // Parsing to Array
        $data['blog'] = $blog;

        // Return to View
        return view('blog', $data);
    }

    public function post(Request $request)
    {
        // Define Value for Session Flash
        $session_post = 'error';
        $session_message = 'Something wrong database server :( please try again.';

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
            $session_post = 'success';
            $session_message = 'Data was successfully created!.';
        } else {
            // Update
            DB::table('blogs')
                ->where('id', $id)
                ->update($post);
            $session_post = 'success';
            $session_message = 'Data was successfully updated!.';
        }

        // Set Session Flash
        Session::flash('post', $session_post);
        Session::flash('message', $session_message);

        // Redirect to Function
        return redirect('blog');
    }

    public function delete(Request $request)
    {
        // Define Value for Session Flash
        $session_post = 'error';
        $session_message = 'Something wrong database server :( please try again.';

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
            $session_post = 'success';
            $session_message = 'Data was successfully deleted!.';
        }

        // Set Session Flash
        Session::flash('post', $session_post);
        Session::flash('message', $session_message);

        // Redirect to Function
        return redirect('blog');
    }
}
