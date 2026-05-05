<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'slug', 'status'];

    public function owner(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function scopeActive($query): Builder
    {
        return $query->where('status', 'active');
    }
}
