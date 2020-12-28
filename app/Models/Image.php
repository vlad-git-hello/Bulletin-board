<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'advert_id',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    public function advert () {
        return $this->belongsTo(Advert::class);
    }
}
