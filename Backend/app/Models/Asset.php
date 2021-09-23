<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory, MediaAlly;

    protected $guarded = [];

    /*
    public function getRouteKeyName()
    {
        return 'slug';
    }
    */
}
