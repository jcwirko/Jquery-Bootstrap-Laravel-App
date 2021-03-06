<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'brand',
        'description',
        'user_id'
    ];

    public function setTotalCostAttribute($value)
    {
        $this->attributes['total_cost'] = $this->unit_price * $this->quantity;
    }
}
