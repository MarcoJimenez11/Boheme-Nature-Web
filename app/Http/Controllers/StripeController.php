<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Exception;

class StripeController extends Controller
{
    /**
     * Crea el producto dado por parámetro en el catálogo de Stripe
     * @param \App\Models\Product $product
     */
    public static function CreateProductStripe(Product $product)
    {
        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            $stripeProduct = $stripe->products->create([
                'name' => $product->name,
                'description' => $product->description,
            ]);

            $stripe->prices->create([
                'currency' => 'eur',
                'unit_amount' => $product->price * 100,
                'product' => $stripeProduct->id,
            ]);

            //Introducir id de Stripe en el producto para vincularlos
            $product->update([
                'stripe_id' => $stripeProduct->id,
            ]);
        } catch (Exception $e) {
            return back()->withErrors([
                'stripe' => 'No se ha podido crear el producto en Stripe: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Edita el producto dado por parámetro en el catálogo de Stripe
     * @param \App\Models\Product $product
     */
    public static function EditProductStripe(Product $product)
    {
        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            $stripe->products->update(
                $product->stripe_id,
                [
                    'name' => $product->name,
                    'description' => $product->description,
                ]
            );
            $price = $stripe->prices->search([
                'query' => 'active:\'true\' AND product:\'' . $product->stripe_id . '\'',
            ]);

            //Si se ha cambiado el precio
            if ($product->price != $price->data[0]->unit_amount / 100) {
                // Desactiva el precio antiguo (Stripe no permite editar precios)
                StripeController::DeactivatePricesStripe($product);
                
                // Se crea un nuevo precio
                $stripe->prices->create([
                    'currency' => 'eur',
                    'unit_amount' => $product->price * 100, // Stripe expects the price in cents
                    'product' => $product->stripe_id,
                ]);
            }
        } catch (Exception $e) {
            return back()->withErrors([
                'stripe' => 'No se ha podido editar el producto en Stripe: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Desactiva el producto dado por parámetro en el catálogo de Stripe
     * @param \App\Models\Product $product
     */
    public static function DeleteProductStripe(Product $product)
    {
        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            StripeController::DeactivatePricesStripe($product);

            // $stripe->products->delete($product->stripe_id, []);
            $stripe->products->update($product->stripe_id, [
                'active' => false,
            ]);
        } catch (Exception $e) {
            return back()->withErrors([
                'stripe' => 'No se ha podido eliminar el producto en Stripe: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Desactiva los precios asignados al producto dado
     * @param \App\Models\Product $product
     */
    public static function DeactivatePricesStripe(Product $product)
    {
        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            // Busca los precios asociados al producto
            $prices = $stripe->prices->search([
                'query' => "product:'{$product->stripe_id}'",
            ]);

            // Desactiva todos los precios asociados al producto
            foreach ($prices->data as $price) {
                $stripe->prices->update($price->id, [
                    'active' => false,
                ]);
            }
        } catch (Exception $e) {
            return back()->withErrors([
                'stripe' => 'No se ha podido desactivar los precios del producto en Stripe: ' . $e->getMessage(),
            ]);
        }
    }
}
