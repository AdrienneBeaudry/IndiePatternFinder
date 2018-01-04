<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Pattern
 *
 * @property-read \App\Company $company
 * @mixin \Eloquent
 */
class Pattern extends Model
{
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'company_id',
        'redirect_url',
        'price',
        'size_type',
        'format',
        'category',
        'image_url',
        'description',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
