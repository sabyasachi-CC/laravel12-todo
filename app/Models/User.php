<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'address', 'status', 'type', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return ['status' => 'boolean', 'password' => 'hashed'];
    }

    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }

    public function isAdmin(): bool
    {
        return $this->type === 'admin';
    }

    public function isActive(): bool
    {
        return $this->status === true;
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->first_name.' '.$this->last_name);
    }
}
