<?php

namespace AttendanceSystem\Models;

use AttendanceSystem\Models\Image;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product';

    protected $fillable = [
        'title',
        'description',
        'assembly_id',
        'standart_of_time',
        'is_assembly'
    ];

    public function orders() {
        return$this->hasMany('AttendanceSystem\Models\Order');
    }

    public function images() {
        return $this->belongsToMany(Image::class, 'product_images');
    }

    public function image() {
        return $this->images()->first();
    }

    public function getThumb() {
        $obj = $this->images()->first();

        if($obj) {
            $name = $obj->name;
            return '/storage/uploads/thumbs/'.$name;
        }

        return 'img/no_image.jpg';
    }



}
