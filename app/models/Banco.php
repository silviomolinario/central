<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table = 'bancos';
    protected $primaryKey = 'ban_id';
    public $timestamps = false;
}
