<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return response()->json($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        $category = Category::create($validated);

        return response()->json(['message' => 'Create category successfully!'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if(!$category){
            return response()->json(['message'=>'Category not found !'], 404);
        }
        $category->type = $request->type ?? $category->type;
        $category->description = $request->description ?? $category->description;
        $category->duration = $request->duration ?? $category->duration;
        $category->save();
        return response()->json(['message'=> 'Update successfully !'], 404);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if(!$category){
            return response()->json(['message'=>'Category not found !'], 404);
        }
        $category->delete();
        return response()->json(['message'=>'Delete category successfully !'], 404);
    }
}
