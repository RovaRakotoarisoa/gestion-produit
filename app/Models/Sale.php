<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'client_id',
        'total',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, SaleItem::class, 'sale_id', 'id', 'id', 'product_id');
    }

}

