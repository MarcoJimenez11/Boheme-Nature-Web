<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderLine;

class OrderController extends Controller
{
    public function list()
    {
        return view('order.list')
        ->with('orders', Order::where('user_id', Auth::user()->id)->orderBy('created_at')->paginate(20))
        ->with("categories", Category::orderBy('name')->get());
    }

    public function create(){
        return view('order.create')
        ->with("categories", Category::orderBy('name')->get());
    }

    public function createPost(){
        if(Auth::user() == null){
            return redirect()->back()->withErrors('Debes iniciar sesión');
        }
        $user_id = Auth::user()->id;
        

        $data = request()->validate([
            'orderProvince' => ['required'],
            'orderLocality' => ['required'],
            'orderDirection' => ['required'],
        ], [
            'orderProvince.required' => 'El campo provincia es obligatorio',
            'orderLocality.required' => 'El campo localidad es obligatorio',
            'orderDirection.required' => 'El campo dirección es obligatorio',
        ]);

        $order = Order::create([
            'user_id' => $user_id,
            'province' => $data['orderProvince'],
            'locality' => $data['orderLocality'],
            'direction' => $data['orderDirection'],
            'status' => 'Pendiente',
        ]);

        $cart = session('cart');
        foreach ($cart as $item) {
            OrderLine::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'amount' => $item['amount'],
            ]);
        }
        session()->forget('cart');

        return $this->list();
    }
}
