<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 * @property string created_at
 * @property string updated_at
 *
 */
class Advert extends Model
{
    use HasFactory;

    public const STATE_NEW = 'new';
    public const STATE_SHABBY = 'shabby';

    public const TYPE_AUTHOR_PRIVATE = 'private';
    public const TYPE_AUTHOR_BUSINESS = 'business';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected array $fillable = [
        'title',
        'overview',
        'price',
        'state',
        'type_author',
        'view',
        'category_id',
        'user_id',
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    /**
     * @return bool
     */
    public function isNew(): bool
    {
        return $this->state === self::STATE_NEW;
    }

    /**
     * @return bool
     */
    public function isShabby(): bool
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

    /**
     * @param int $id
     * @return bool
     */
    public function isAuthor(int $id): bool
    {
        return $this->user_id === $id;
    }

    /**
     * @return string[]
     */
    public static function getTypeAuthors(): array
    {
        return [
            self::TYPE_AUTHOR_BUSINESS => 'Business',
            self::TYPE_AUTHOR_PRIVATE => 'Private person',
        ];
    }

    /**
     * @return string[]
     */
    public static function getStateTypes(): array
    {
        return [
            self::STATE_NEW => 'New',
            self::STATE_SHABBY => 'Shabby'
        ];
    }
}
