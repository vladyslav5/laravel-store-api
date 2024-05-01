<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Response;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $newCategory = Category::create($request->validated());

        return new CategoryResource($newCategory);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new CategoryResource(Category::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryStoreRequest $request,Category $category)
    {
        $category->update($request->validated());
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category )
    {
//        $category->products()->delete();
        $category->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
