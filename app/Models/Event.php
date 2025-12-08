<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'event_date',
        'location',
        'thumbnail',
        'content',              
        'status',
    ];
}
