<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Exception;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs =  Blog::all();
        return response()->json([
            'success' => 'true',
            'message' => '',
            'code' => '200',
            'data' => $blogs,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:blogs',
            'description' => 'required|min:10'
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;
        try {
            $blog->save();
            return response()->json([
                'success' => 'true',
                'message' => 'Data stored successfully',
                'code' => '201',
                'data' => $blog,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => 'false',
                'message' => 'Something went wrong',
                'code' => $e->getCode(),
                'data' => $e->getMessage(),
            ]);
        }
    }
}
