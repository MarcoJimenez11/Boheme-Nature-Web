<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo de línea de pedido
 */
class OrderLine extends Model
{
    /** @use HasFactory<\Database\Factories\OrderLineFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'amount',
    ];

    /**
     * La relación entre la línea de pedido y el producto
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Product, OrderLine>
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
