<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'game_id',
        'user_id',
        'platform_id',
        'price',
        'discount',
    ];


    public function game(){
        return $this->belongsTo(Game::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function platform(){
        return $this->belongsTo(Platform::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems()
    {
        return $this->hasOne(OrderItem::class);
    }

}


