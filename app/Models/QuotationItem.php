<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    use HasFactory;     

    public function products()
    {
        return $this->belongsTo(Product::class, 'ItemCode', 'productCode');
    }

    public function stock()
    {
        return $this->belongsTo(Product::class, 'whsCode', 'whsCode');
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}