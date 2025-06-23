<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    function books()
    {
        return $this->belongsToMany(Book::class, 'borrow_book')
                    ->withPivot('duration')
                    ->withTimestamps();
    }
}
