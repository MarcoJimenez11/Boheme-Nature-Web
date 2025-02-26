<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Mail\OrderEmail;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Models\OrderLine;

class EmailVerificationController extends Controller
{
    public function notice()
    {
        return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('home');
    }

    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', '¡Enlace de verificación enviado!');
    }

    /**
     * Envía un email al usuario con la información de su pedido
     * @param mixed $userEmail
     * @param mixed $order_id
     * @return mixed
     */
    public function sendOrderEmail($userEmail, $order_id){
        $order = Order::find($order_id);
        $orderLines = OrderLine::where('order_id', '=', $order->id)->orderBy('created_at')->get();

        Mail::to($userEmail)->send(new OrderEmail($order, $orderLines));

        return redirect()->route('orderList');
    }
}
