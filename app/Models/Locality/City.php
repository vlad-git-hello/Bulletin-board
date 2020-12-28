<?php

declare(strict_types=1);

namespace App\Models\Locality;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * @package App\Models\Locality
 */
class City extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'region_id',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    public function region () {
        return $this->belongsTo(Region::class);
    }
}
