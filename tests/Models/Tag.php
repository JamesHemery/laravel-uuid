<?php

namespace Jamesh\Uuid\Test\Models;

use Illuminate\Database\Eloquent\Model;
use Jamesh\Uuid\HasUuid;

class Tag extends Model
{
    use HasUuid;

    protected $guarded = [];
    public $timestamps = false;

    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
