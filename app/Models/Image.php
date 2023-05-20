<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];

    
    protected $appends = ['name_path'];
    

    public function getNamePathAttribute()
    {
        return 'https://image.tmdb.org/t/p/w500' . $this->name;
    }
}
