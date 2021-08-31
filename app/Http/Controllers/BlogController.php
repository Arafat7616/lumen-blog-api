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

    public function show($id){
        $blog =  Blog::find($id);
        if($blog){
            return response()->json([
                'success' => 'true',
                'message' => '',
                'code' => '200',
                'data' => $blog,
            ]);
        }else{
            return response()->json([
                'success' => 'false',
                'message' => 'Data not found',
                'code' => '404',
            ]);
        }
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
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]);
        }
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'title' => 'required|unique:blogs,title,'.$id,
            'description' => 'required|min:10'
        ]);
        $blog =  Blog::find($id);
        if($blog){
            $blog->title = $request->title;
            $blog->description = $request->description;
            try {
                $blog->save();
                return response()->json([
                    'success' => 'true',
                    'message' => 'Data update successfully',
                    'code' => '200',
                    'data' => $blog,
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'success' => 'false',
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                ]);
            }
        }else{
            return response()->json([
                'success' => 'false',
                'message' => 'Data not found',
                'code' => '404',
            ]);
        }
    }

    public function destroy($id){
        $blog =  Blog::findOrFail($id);
        if($blog){
            $blog->delete();
            return response()->json([
                'success' => 'true',
                'message' => 'Blog deleted successfully',
                'code' => '200',
            ]);
        }else{
            return response()->json([
                'success' => 'false',
                'message' => 'Data not found',
                'code' => '404',
            ]);
        }
    }
}
