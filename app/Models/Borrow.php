<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_at',
        'end_date',
        'status',
        'quantity',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'borrow_book')
                    ->withPivot('duration')
                    ->withTimestamps();
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Format start_at date as d-m-Y
    public function getStartAtAttribute($value)
    {
        return $value ? date('d-m-Y', strtotime($value)) : null;
    }

    // Format end_date as d-m-Y
    public function getEndDateAttribute($value)
    {
        return $value ? date('d-m-Y', strtotime($value)) : null;
    }

    // Optional: format status nicely
    public function getStatusAttribute($value)
    {
        return ucfirst($value); // e.g. "pending" -> "Pending"
    }
}
