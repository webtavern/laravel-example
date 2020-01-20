<?php

namespace AttendanceSystem\Models;

use Illuminate\Database\Eloquent\Model;

class Inwork extends Model
{
    protected $table = 'in_work';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'user_id'
    ];

    public function order() {
        return $this->belongsTo('AttendanceSystem\Models\Order');
    }

    public function user() {
        return $this->belongsTo('AttendanceSystem\Models\User');
    }
}
