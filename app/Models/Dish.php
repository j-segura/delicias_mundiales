<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $table = 'dishes';
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'dishes_categories');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
