<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'type', 'quantity'];
    //type:add,sell
    const ADD = "add";
    const SELL = "sell";

}
