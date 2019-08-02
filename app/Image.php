<?php

namespace AttendanceSystem;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'image';

    public $images;

}
