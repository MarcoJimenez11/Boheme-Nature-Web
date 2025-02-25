<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Throwable;
use Illuminate\Validation\Rule;

use function Laravel\Prompts\alert;

class CategoryController extends Controller
{

    public function list()
    {
        return view('category.list')->with("categories", Category::orderBy('name')->paginate(perPage: 20));
    }

    public function create()
    {
        return view('category.create')->with("categories", Category::orderBy('name')->get());
    }

    public function createPost()
    {
        $data = request()->validate([
            'categoryName' => ['required', 'unique:categories,name'],
        ], [
            'categoryName.required' => 'El campo nombre es obligatorio',
            'categoryName.unique' => 'Ya existe una categoría con ese nombre',
        ]);

        Category::create([
            'name' => $data['categoryName'],
        ]);

        return redirect()->route('categoryList');
    }

    public function edit(Category $category)
    {
        return view('category.edit')
        ->with("category", $category)
        ->with("categories", Category::orderBy('name')->get());
    }

    public function editPut(Category $category)
    {
        $data = request()->validate([
            'categoryName' => ['required', Rule::unique('categories','name')->ignore($category->id)],
        ], [
            'categoryName.required' => 'El campo nombre es obligatorio',
            'categoryName.unique' => 'Ya existe una categoría con ese nombre',
        ]);

        $category->update(['name' => $data['categoryName']]);

        return redirect()->route('categoryList');
    }

    public function delete(Category $category){
        try{
            $category->delete();
        }catch(Throwable $e){
            return back()->withErrors([
                'delete' => 'No se ha podido borrar la categoría porque tiene productos asignados',
            ]);
        }
        
        
        return redirect()->route('categoryList');
    }
}
