<?php

declare(strict_types=1);

namespace App\Models\Locality;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Region
 * @package App\Models\Locality
 *
 * @property int id
 * @property string name
 */
class Region extends Model
{
    use HasFactory;

    /**
     * @var array|string[]
     */
    protected array $fillable = [
        'name',
    ];

    /**
     * @var bool
     */
    public bool $timestamps = false;

    /**
     * @return HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
