<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'size',
        'color',
        'category',
        'image',
        'stock',
        'is_active'
    ];

    protected $appends = ['image_url', 'available_stock'];

    public function getImageUrlAttribute()
    {
        return $this->image;
    }

    public function getHasImageAttribute()
    {
        return !empty($this->image);
    }

    public function getAvailableStockAttribute()
    {
        $reservedInBaskets = $this->baskets()->whereHas('user', function($query) {
            $query->where('id', '!=', auth()->id()); // Исключаем текущего пользователя
        })->sum('quantity');

        return max(0, $this->stock - $reservedInBaskets);
    }

    public function getCanAddToBasketAttribute()
    {
        if (!auth()->check()) {
            return $this->available_stock > 0;
        }

        $currentUserQuantity = $this->baskets()->where('user_id', auth()->id())->sum('quantity');
        return ($this->available_stock - $currentUserQuantity) > 0;
    }

    public function getMaxAvailableQuantityAttribute()
    {
        if (!auth()->check()) {
            return $this->available_stock;
        }

        $currentUserQuantity = $this->baskets()->where('user_id', auth()->id())->sum('quantity');
        return max(0, $this->available_stock - $currentUserQuantity);
    }

    public function baskets()
    {
        return $this->hasMany(Basket::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'baskets')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
