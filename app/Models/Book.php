<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id', 'price'];

    public function borrows()
    {
        return $this->belongsToMany(Borrow::class, 'borrow_book')
            ->withPivot('duration')
            ->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Format created_at date as d-m-Y
    public function getCreatedAtAttribute($value)
    {
        return $value ? date('d-m-Y', strtotime($value)) : null;
    }

    // Format updated_at date as "F d, Y"
    public function getUpdatedAtAttribute($value)
    {
        return $value ? date('F d, Y', strtotime($value)) : null;
    }

    // Format price attribute with a dollar sign and two decimals
    public function getPriceAttribute($value)
    {
        return $value !== null ? '$' . number_format($value, 2) : null;
    }
}
