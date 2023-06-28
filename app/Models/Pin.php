<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pin extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'description'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class)
            ->orderBy('is_done', 'asc')
            ->orderBy('priority', 'desc');
    }
}
