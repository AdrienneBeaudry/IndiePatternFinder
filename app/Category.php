<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'synonyms',
    ];

    /**
     * @return mixed
     */
    public function pattern() {
        return $this->hasMany(Pattern::class);
    }
}
