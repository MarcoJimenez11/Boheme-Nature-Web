<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderLine;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class OrderLineController extends Controller
{
    public function list(Order $order)
    {
        $orderLines = OrderLine::where('order_id', '=', $order->id)->orderBy('created_at')->get();
        $totalCost = $order->getTotalCost();
        // foreach ($orderLines as $line) {
        //     $totalCost += Product::find($line->product_id)->price * $line->amount;
        // }
        return view('orderline.list')
            ->with('orderLines', $orderLines)
            ->with('totalCost', $totalCost)
            ->with("categories", Category::orderBy('name')->get());
    }
}
