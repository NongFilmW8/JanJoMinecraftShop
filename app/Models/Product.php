<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_type',
        'amount',
        'photo',
        'confirmed',
        'votes',
        'created_date',
    ];

    public function productType() // ความสัมพันธa Many-to-One กับ ProductType
    {
        return $this->belongsTo(ProductType::class, 'product_type');
    }
}
