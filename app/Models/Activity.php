<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo',
        'description',
        'date',
        'category_id',
        'is_challenge'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user_activities()
    {
        return $this->hasMany(UserActivity::class);
    }
    public static function boot(){
        parent::boot();
        static::deleting(function ($activities){
            $activities->user_activities()->delete();
        });
    }
}
