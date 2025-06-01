<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderLine;

/**
 * Controlador de pedidos
 */
class OrderController extends Controller
{
    /**
     * Vista de listado de pedidos realizados por el usuario autenticado
     * @return \Illuminate\Contracts\View\View
     */
    public function list()
    {
        //Devuelve los pedidos del usuario con sus líneas de pedido y productos
        $orders = Order::with('orderLines.product')->where('user_id', Auth::user()->id);

        return view('order.list')
            ->with('orders', $orders->orderBy('created_at')->paginate(20))
            ->with("categories", Category::orderBy('order')->get());
    }

    /**
     * Vista de creación de un nuevo pedido (a partir de los productos del carrito)
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('order.create')
            ->with("categories", Category::orderBy('order')->get())
            ->with("cartItems", session('cart'));
    }

    /**
     * Creación de un pedido a partir de los productos del carrito, el formulario de envío y el usuario autenticado
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function createPost()
    {
        if (Auth::user() == null) {
            return redirect()->back()->withErrors('Debes iniciar sesión');
        }
        $user = Auth::user();

        //Validación de los datos del formulario
        $data = request()->validate([
            'orderProvince' => ['required'],
            'orderLocality' => ['required'],
            'orderDirection' => ['required'],
            'stripeToken' => ['required'],
        ], [
            'orderProvince.required' => 'El campo provincia es obligatorio',
            'orderLocality.required' => 'El campo localidad es obligatorio',
            'orderDirection.required' => 'El campo dirección es obligatorio',
            'stripeToken.required' => 'No se ha recibido el token de pago de Stripe',
        ]);

        //Comprueba el carrito
        $cart = session('cart');
        if (!$cart || count($cart) == 0) {
            return redirect()->back()->withErrors('El carrito está vacío');
        }

        // Calcula el precio total del pedido
        $total = 0;
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            $total += $product->price * $item['amount'];
        }

        // Realiza el pago en Stripe
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        try {
            $charge = \Stripe\Charge::create([
                'amount' => intval($total * 100), // Stripe requiere la cantidad en céntimos
                'currency' => 'eur',
                'description' => 'Pedido en Boheme Nature',
                'source' => $data['stripeToken'],
                'metadata' => [
                    'user_id' => $user->id,
                    'email' => $user->email,
                ],
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error en el pago: ' . $e->getMessage());
        }

        //Crea el pedido
        $order = Order::create([
            'user_id' => $user->id,
            'province' => $data['orderProvince'],
            'locality' => $data['orderLocality'],
            'direction' => $data['orderDirection'],
            'status' => 'Pendiente',
        ]);

        //Crea las líneas del pedido a partir del carrito
        foreach ($cart as $item) {
            OrderLine::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'amount' => $item['amount'],
            ]);

            //Decrementa el stock de los productos comprados
            Product::where('id', '=', $item['id'])->decrement('stock', $item['amount']);
        }
        //Borra el carrito
        session()->forget('cart');

        //Envía email de confirmación de pedido al usuario
        return redirect()->route('orderEmail.send', ['userEmail' => Auth::user()->email, 'order' => $order]);
    }
}
