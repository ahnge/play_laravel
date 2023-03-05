<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $category = new Category;
        $category->name = request()->name;
        $category->save();

        return $category;
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        return Category::find($category->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $category = Category::find($category->id);
        $category->name = request()->name;
        $category->save();

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category = Category::find($category->id);
        $category->delete();

        return $category;
    }
}
