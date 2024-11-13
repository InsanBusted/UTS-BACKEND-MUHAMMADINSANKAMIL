<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $berita = Berita::all();

        if ($berita->count() > 0) {
        
        return response()->json([
            'messages' => "Get All resource",
            'data' => $berita,
        ], 200);
    } else {
        return response()->json([
            'messages' => "Data is empty",
        ], 200);
    }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            "title" => "required",
            "author" => "required",
            "description" => "required",
            "content" => "required|max:255",
            "url" => "required",
            "url_image" => "required",
            "category" => "required",
            "publised_at" => "required|date",
           ]); 
            if ($validator->fails()) { 
                return response()->json([ 
                    'message' => 'Validation errors', 
                    'errors' => $validator->errors(), 
                ], 422); 
            } 
     
            $news = Berita::create($request->all()); 
     
            
            return response()->json([
                'message' => 'Resource is added succesfully', 
                'data' => $news,
            ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $news = Berita::find($id);

        if (!$news) {
            $response = [
                'message' => 'Resource Not Found'
            ];
            return response()->json($response, 404);
        } else {
            $response = [
                'message' => 'Get Detail Resource',
                'data'=> $news
            ];

            return response()->json($response, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $news = Berita::find($id); 
        if ($news) { 
            $input = [ 
                'id' => $request->id ?? $news->id, 
                'title' => $request->title ?? $news->title, 
                'author' => $request->author ?? $news->author, 
                'description' => $request->description ?? $news->description, 
                'content' => $request->content ?? $news->content, 
                'url' => $request->url ?? $news->url,  
                'url_image' => $request->url_image ?? $news->url_image,                     
                'category' => $request->category ?? $news->category,
                'publised_at' => $request->publised_at ?? $news->publised_at, 
            ]; 
            $news->update($input); 
            $data = [ 
                'message' => 'Resource is update successfully', 
                'data' => $news 
            ]; 
            return response()->json($data, 200); 
        } else { 
            $data = [ 
                'message' => 'Resource not found' 
            ]; 
            return response()->json($data, 404); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $news = Berita::find($id);

        if (!$news) {
            return response()->json([
                'message'=> 'Resource not found'
            ], 404);
        } else {
            return response()->json([
                'message' => 'Resource is deleted succesfully',
            ], 200);
        }
    }
}
