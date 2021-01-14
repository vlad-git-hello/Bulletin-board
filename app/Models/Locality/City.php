<?php

declare(strict_types=1);

namespace App\Models\Locality;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class City
 * @package App\Models\Locality
 *
 * @property int id
 * @property string name
 * @property int region_id
 */
class City extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected array $fillable = [
        'name',
        'region_id',
    ];

    /**
     * @var bool
     */
    public bool $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}
