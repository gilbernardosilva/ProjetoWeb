<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
       'description',
       'category_id',
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function photos(){
        return $this->hasMany(Photo::class);
    }

}
