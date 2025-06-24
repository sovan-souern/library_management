<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'gender',
        'book_id',
    ];

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    // Format phone number (example: remove spaces, format nicely)
    public function getPhoneAttribute($value)
    {
        // Example: Format phone as (123) 456-7890 if 10 digits
        $clean = preg_replace('/\D+/', '', $value);
        if (strlen($clean) == 10) {
            return sprintf('(%s) %s-%s', 
                substr($clean, 0, 3),
                substr($clean, 3, 3),
                substr($clean, 6));
        }
        return $value; // fallback, return raw
    }

    // Capitalize gender for display
    public function getGenderAttribute($value)
    {
        return ucfirst(strtolower($value));
    }
}
