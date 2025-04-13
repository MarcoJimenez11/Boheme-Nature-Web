<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Throwable;
use Illuminate\Validation\Rule;

use function Laravel\Prompts\alert;

/**
 * Controlador de Categorías
 */
class CategoryController extends Controller
{

    /**
     * Lista de categorías (vista de administrador)
     * @return \Illuminate\Contracts\View\View
     */
    public function list()
    {
        return view('category.list')->with("categories", Category::orderBy('order')->paginate(perPage: 20));
    }

    /**
     * Vista para crear una nueva categoría
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('category.create')->with("categories", Category::orderBy('order')->get());
    }

    /**
     * Crea una nueva categoría a partir de los datos del formulario de la petición POST
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
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

    /**
     * Vista de edición de una categoría
     * @param \App\Models\Category $category
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Category $category)
    {
        return view('category.edit')
        ->with("category", $category)
        ->with("categories", Category::orderBy('order')->get());
    }

    /**
     * Edita una categoría a partir de los datos del formulario de la petición PUT
     * @param \App\Models\Category $category
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
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

    /**
     * Elimina una categoría a partir de una petición DELETE
     * @param \App\Models\Category $category
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
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
