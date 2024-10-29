<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];

    protected $guarded = [];

    public function dishes()
    {
        return $this->hasMany('App\Models\Dish');
    }
}
