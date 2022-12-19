<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function categories(){
        return $this->belongsTo(Category::class);
    }


}
