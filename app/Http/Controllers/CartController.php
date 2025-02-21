<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CartController extends Controller
{
    public function list()
    {
        return view('cart.list')
            ->with("categories", Category::orderBy('name')->get())
            ->with("cartItems", session('cart'));
    }

    public function addItem($product)
    {
        session()->push('cart', ['id' => $product, 'amount' => 1]);
        return redirect()->back();
    }

    public function deleteItem($item)
    {
        session()->forget("cart.$item");
        return redirect()->back();
    }

    public function changeAmountItem($item, $add)
    {
        $currentAmount = session("cart.$item.amount");
        if ($currentAmount + $add > 0) {
            session()->put("cart.$item.amount", $currentAmount + $add);
        }
        return redirect()->back();
    }

    public function deleteAll()
    {
        session()->forget("cart");
        return redirect()->back();
    }
}
