<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Mail\OrderEmail;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Models\OrderLine;

/**
 * Controlador de envío de emails de verificación de usuario y confirmación de pedidos
 */
class EmailVerificationController extends Controller
{
    /**
     * Vista de notificación de verificación de email
     * @return \Illuminate\Contracts\View\View
     */
    public function notice()
    {
        return view('auth.verify-email');
    }

    /**
     * Endpoint para verificar el email del usuario desde el botón del correo enviado
     * @param \Illuminate\Foundation\Auth\EmailVerificationRequest $request
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('home');
    }

    /**
     * Envía otro email de verificación al usuario
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
