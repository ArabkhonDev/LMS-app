<?php

namespace App\Models;

use App\Traits\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
    use HasFactory, Guarded;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function views()
    {
        return $this->hasMany(NewsViews::class);
    }

    public function viewers()
    {
        return $this->belongsToMany(User::class, 'news_views')->withTimestamps();
    }
}
