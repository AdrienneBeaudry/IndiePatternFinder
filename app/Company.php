<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Company
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Pattern[] $pattern
 * @mixin \Eloquent
 */
class Company extends Model
{
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
    ];

    /**
     * @return mixed
     */
    public function pattern() {
        return $this->hasMany(Pattern::class);
    }
}
