<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tag'];
    public $timestamps = false;

    public function posts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }
}
