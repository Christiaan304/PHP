<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\DataTables\SubcategoryDataTable;
use App\Http\Requests\CreateSubcategoryRequest;
use App\Http\Requests\UpdateSubcategoryRequest;

class SubcategoryController extends Controller
{
    public function index(SubcategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.subcategory.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategory.create', compact('categories'));
    }

    public function store(CreateSubcategoryRequest $request)
    {
        $subcategory = new Subcategory();
        $subcategory->category_id = $request->parent_category;
        $subcategory->name = $request->subcategory_name;
        $subcategory->slug = Str::slug($request->subcategory_name);
        $subcategory->status = $request->subcategory_status;
        $subcategory->save();

        toastr('Subcategory created successfully', 'success');
        return redirect()->route('admin.subcategory.index');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $categories = Category::all();
        $subcategory = Subcategory::findOrFail($id);
        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(UpdateSubcategoryRequest $request, string $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->category_id = $request->parent_category;
        $subcategory->name = $request->subcategory_name;
        $subcategory->slug = Str::slug($request->subcategory_name);
        $subcategory->status = $request->subcategory_status;
        $subcategory->save();

        toastr('Subcategory updated successfully', 'success');
        return redirect()->route('admin.subcategory.index');
    }

    public function destroy(string $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();

        toastr('Subcategory deleted successfully', 'success');
        return redirect()->route('admin.subcategory.index');
    }
}
