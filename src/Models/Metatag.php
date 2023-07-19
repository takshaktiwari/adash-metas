<?php

namespace Takshak\Ametas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metatag extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'tags'  =>  'collection'
    ];

    public function getIsGlobalAttribute()
    {
        return $this->url ? false : true;
    }
}
