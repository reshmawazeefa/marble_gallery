<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'partner_code',
        'phone',
        'email',
        'partner_type',
        'alt_phone',
        'designation',
        'address',
        'description'
    ];
}
