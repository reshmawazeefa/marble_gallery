<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    public function Warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'whsCode', 'whsCode');
    }

    public function Product()
    {
        return $this->belongsTo(Product::class, 'productCode', 'productCode');
    }
}
