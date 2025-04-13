<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderLine;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

/**
 * Controlador de líneas de pedido
 */
class OrderLineController extends Controller
{
    /**
     * Vista de listado de líneas de pedido de un pedido
     * @param \App\Models\Order $order
     * @return \Illuminate\Contracts\View\View
     */
    public function list(Order $order)
    {
        $orderLines = OrderLine::where('order_id', '=', $order->id)->orderBy('created_at')->get();
        $totalCost = $order->getTotalCost();

        return view('orderline.list')
            ->with('orderLines', $orderLines)
            ->with('totalCost', $totalCost)
            ->with("categories", Category::orderBy('order')->get());
    }
}
