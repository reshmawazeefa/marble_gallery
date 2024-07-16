<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {        
        return $this->belongsTo(Category::class, 'categoryCode', 'categoryCode');
    }

    public function stock()
    {
        return $this->belongsTo(ProductStock::class, 'productCode', 'productCode');
    }
}
