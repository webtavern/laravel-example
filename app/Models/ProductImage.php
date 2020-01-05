<?php

namespace AttendanceSystem\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = [
        'image_id',
        'product_id'
    ];

    public function product()
    {
        return $this->hasOne('AttendanceSystem\Models\Product');
    }
}
