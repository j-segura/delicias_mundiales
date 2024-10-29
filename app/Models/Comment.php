<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];

    protected $guarded = [];

    public function dish()
    {
        return $this->belongsTo(Dish::class, 'dish_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
