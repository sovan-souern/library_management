<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    function borrows()
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
}
