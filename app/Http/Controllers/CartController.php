<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

/**
 * 
 * Controlador para la gestión del carrito de la compra
 */
class CartController extends Controller
{
    /**
     * Listado de productos del carrito
     * @return \Illuminate\Contracts\View\View
     */
    public function list()
    {
        return view('cart.list')
            ->with("categories", Category::orderBy('order')->get())
            ->with("cartItems", session('cart'));
    }

    /**
     * Añade un producto al carrito, comprobando si ya existe para no añadir duplicado sino aumentar su cantidad en 1
     * 
     * @param mixed $product
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function addItem($product)
    {
        $cart = session('cart', []);
        $itemFound = false;

        foreach ($cart as $index => $item) {
            if ($item['id'] == $product) {
                $this->changeAmountItem($index, 1);
                $itemFound = true;
                break;
            }
        }

        if (!$itemFound) {
            session()->push('cart', ['id' => $product, 'amount' => 1]);
        }
        return redirect()->back();
    }

    /**
     * Elimina un producto del carrito
     * @param mixed $item
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function deleteItem($item)
    {
        session()->forget("cart.$item");
        return redirect()->back();
    }

    /**
     * Aumenta o disminuye la cantidad de items de una línea del carrito,
     * comprobando que no sea ni menor a 1 ni mayor al stock del producto
     * @param mixed $item
     * @param mixed $add
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function changeAmountItem($item, $add)
    {
        $currentAmount = session("cart.$item.amount");
        $productStock = Product::where('id', '=',session("cart.$item.id"))->first()->stock;

        if ($currentAmount + $add > 0 && $currentAmount + $add <= $productStock) {
            session()->put("cart.$item.amount", $currentAmount + $add);
        }
        return redirect()->back();
    }


    /**
     * 
     * Elimina todos los productos del carrito (vaciar el carrito)
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        session()->forget("cart");
        return redirect()->back();
    }
}
