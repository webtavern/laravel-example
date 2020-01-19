<?php

namespace AttendanceSystem\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'product_id',
        'quantity',
        'closed_at'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_order');
    }

    public function product()
    {
        return $this->belongsTo('AttendanceSystem\Models\Product');
    }

    public function hasWorker($id)
    {
        if ($this->users->contains('id', $id)) {
            return true;
        }

        return false;
    }
}
