<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderLine;

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

    public function getTotalCost(){
        $orderLines = OrderLine::where('order_id', '=', $this->id)->orderBy('created_at')->get();
        $totalCost = 0;
        foreach ($orderLines as $line) {
            $totalCost += Product::find($line->product_id)->price * $line->amount;
        }
        return $totalCost;
    }
}
