<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Pattern
 *
 * @property-read \App\Company $company
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $company_id
 * @property string $redirect_url
 * @property string|null $company_product_id
 * @property string|null $price
 * @property string|null $size_type
 * @property string|null $format
 * @property string|null $category
 * @property string|null $image_url
 * @property string|null $description
 * @property string|null $supplies
 * @property string|null $language
 * @property string|null $full_description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pattern whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pattern whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pattern whereCompanyProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pattern whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pattern whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pattern whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pattern whereFullDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pattern whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pattern whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pattern whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pattern whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pattern wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pattern whereRedirectUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pattern whereSizeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pattern whereSupplies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Pattern whereUpdatedAt($value)
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
        'company_pattern_id',
        'price',
        'size_type',
        'format',
        'category_id',
        'image_url',
        'description',
        'supplies',
        'language',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function category() {
        return $this->hasMany(Category::class);
    }
}
