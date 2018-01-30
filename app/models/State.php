<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'estados';
    public $timestamps = false;
    
    protected $fillable = [
        'abbrev',
        'name',
        'slug',
        'order',
    ];
}
