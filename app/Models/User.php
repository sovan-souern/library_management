<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relations
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    // Accessor: full name combining first and last
    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    // Accessor: capitalize gender on access
    public function getGenderAttribute($value)
    {
        return ucfirst(strtolower($value));
    }

    // Mutator: clean first name before saving
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst(strtolower($value));
    }

    // Mutator: clean last name before saving
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst(strtolower($value));
    }
}
