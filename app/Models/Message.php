<?php

namespace AttendanceSystem\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';

    protected $fillable = [
        'from_id',
        'to_id',
        'body'
    ];
}
