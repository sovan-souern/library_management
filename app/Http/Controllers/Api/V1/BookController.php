<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $books = Book::all();
       return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $books = new Book();
        $books->name = $request->name;
        $books->description = $request->description;
        $books->category_id = $request->category_id;
        $books->save();
        return response()->json($books, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $books = Book::find($id);
        return response()->json($books);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $books = Book::find($id);
        $books->name= $request->name ?? $books->name;
        $books->description= $request->description ?? $books->description;
        $books->category_id= $request->category_id ?? $books->category_id;
        $books->save();
        return response()->json(['message'=>'Update book succefully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $books = Book::find($id);
        if(!$books){
            return response()->json(['message'=>'Not found book'], 404);

        }
        $books->delete();
        return response()->json(['message'=>'Delete book successfully'], 200);
    }
}
