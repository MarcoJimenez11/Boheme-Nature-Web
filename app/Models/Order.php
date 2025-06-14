<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderLine;

/**
 * Modelo de Pedido
 */
class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'province',
        'locality',
        'direction',
        'status',
        'created_at'
    ];

    /**
     * La relación entre el pedido y sus líneas de pedido
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<OrderLine, Order>
     */
    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }

    /**
     * Devuelve el coste total del pedido según sus líneas de pedido
     * @return float|int
     */
    public function getTotalCost()
    {
        $orderLines = OrderLine::where('order_id', '=', $this->id)->orderBy('created_at')->get();
        $totalCost = 0;
        foreach ($orderLines as $line) {
            $totalCost += Product::find($line->product_id)->price * $line->amount;
        }
        return $totalCost;
    }
}
