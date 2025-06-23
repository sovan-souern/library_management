<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;


public function books()
{
    return $this->belongsToMany(\App\Models\Book::class, 'borrow_book')
                ->withPivot('quantity', 'return_date', 'status')
                ->withTimestamps();
}

// In Borrow.php model
public function user()
{
    return $this->belongsTo(User::class);
}

}
