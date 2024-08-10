<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory,HasUuids;

    protected $fillable = [
        'category_product_id',
        'name',
        'price',
        'image'
    ];

    public function category_product(): BelongsTo
    {
        return $this->belongsTo(CategoryProduct::class);
    }
}
