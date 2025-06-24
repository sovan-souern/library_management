<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description',
        'duration',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    // Format duration as string with "days" appended (assuming duration is integer days)
    public function getDurationAttribute($value)
    {
        return $value !== null ? $value . ' days' : null;
    }

    // Capitalize the first letter of the type attribute for display
    public function getTypeAttribute($value)
    {
        return ucfirst($value);
    }
}
