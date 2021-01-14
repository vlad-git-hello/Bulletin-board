<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Advert
 * @package App\Models
 *
 * @property int id
 * @property string title
 * @property string overview
 * @property int price
 * @property array state
 * @property array type_author
 * @property int view
 * @property int category_id
 * @property int user_id
 *
 */
class Advert extends Model
{
    use HasFactory;

    public const STATE_NEW = 'new';
    public const STATE_SHABBY = 'shabby';

    public const TYPE_AUTHOR_PRIVATE = 'private';
    public const TYPE_AUTHOR_BUSINESS = 'business';

    protected $fillable = [
        'title',
        'overview',
        'price',
        'state',
        'type_author',
        'view',
        'category_id',
        'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * @return bool
     */
    public function isNew()
    {
        return $this->state === self::STATE_NEW;
    }

    /**
     * @return bool
     */
    public function isShabby()
    {
        return $this->state === self::STATE_SHABBY;
    }

    /**
     * @return bool
     */
    public function isBusiness(): bool
    {
        return $this->type_author ===  self::TYPE_AUTHOR_BUSINESS;
    }

    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        return $this->type_author === self::TYPE_AUTHOR_PRIVATE;
    }

    /**
     * @return string
     */
    public function shortOverview(): string
    {
        return mb_substr($this->overview, 0, 40) . '...';
    }
}
