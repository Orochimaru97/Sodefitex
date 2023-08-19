<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\Status;

/**
 * App\Models\Language
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $rtl
 * @property string $status
 * @property string $is_default
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language query()
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereRtl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|array<\App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|array<\App\Models\Product> $products
 * @property-read int|null $products_count
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereDeletedAt($value)
 * @mixin \Eloquent
 */
class Language extends Model
{
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    public const IS_DEFAULT = 1;
    public const IS_NOT_DEFAULT = 0;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'status',
        'is_default',
    ];


    protected $casts = [
        'status'         => Status::class,
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'language_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'language_id');
    }
}
