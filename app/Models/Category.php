<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Class Category
 * @package App\Models
 *
 * @property string title
 * @property int parent_id
 *
 * @method static defaultOrder
 */
class Category extends Model
{
    use HasFactory;
    use NodeTrait;

    /**
     * @var string[]
     */
    protected array $fillable = [
        'title',
        'parent_id',
    ];

    /**
     * @var bool
     */
    public bool $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }
}
