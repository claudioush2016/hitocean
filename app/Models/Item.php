<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public $table = "item";
    protected $fillable = [
        'name',
        'type_id',
        'attack',
        'deff'
    ];
}
