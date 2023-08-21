<?php

namespace App\Http\Controllers\Backend;

use Str;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CategoryDataTable;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->category_name;
        $category->slug = Str::slug($request->category_name);
        $category->icon = $request->category_icon;
        $category->status = $request->category_status;
        $category->save();

        toastr('Category added successfully', 'success', ['timeOut' => 5000]);
        return redirect()->route('admin.category.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = Category::findOrFail($id);

        $category->name = $request->category_name;
        $category->icon = $request->category_icon;
        $category->status = $request->category_status;
        $category->save();

        toastr('Category updated successfully', 'success');
        return redirect()->route('admin.category.index');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response(['status' => 'success', 'Deleted successfully']);
    }
}
