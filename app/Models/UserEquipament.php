<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEquipament extends Model
{
    use HasFactory;
    public $table = "user_equipament";
    protected $fillable = [
        'user_id',
        'item_id'
    ];
}
