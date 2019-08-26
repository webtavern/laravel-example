<?php

namespace AttendanceSystem;

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
        'main_image_id',
    ];

    public function images()
    {
        return $this->belongsToMany('AttendanceSystem\Image', 'product_images');
    }

    public function image() {
        $img = Image::findOrFail($this->main_image_id);

        return $img->path;
    }



}
