<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;

class OrderController extends Controller
{
    public function list()
    {
        return view('order.list')
        ->with("orders", Order::orderBy('created_at')->get())
        ->with("categories", Category::orderBy('name')->get());
    }
}
