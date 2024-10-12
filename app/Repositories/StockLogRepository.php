<?php

namespace App\Repositories;

use App\Models\StockLog;
use App\Models\Product;

class StockLogRepository
{


    public function add($product_id, $type, $quantity)
    {
        StockLog::create([
            'product_id' => $product_id,
            'type' => $type,
            'quantity' => $quantity,
        ]);

        $product = Product::find($product_id);
        if ($product) {
            $product->quantity_available = $this->getAvailableQuantities($product_id);
            $product->update();
        }

        return true;

    }

    public function getAvailableQuantities($product_id)
    {
        $new_quantities = StockLog::where('product_id', $product_id)
            ->where('type', StockLog::ADD)->sum('quantity');

        $quantities_sold = StockLog::where('product_id', $product_id)
            ->where('type', StockLog::SELL)->sum('quantity');

        return $new_quantities - $quantities_sold;

    }

}