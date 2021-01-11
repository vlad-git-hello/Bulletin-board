<?php

declare(strict_types=1);

/**
 *
 */

namespace App\Models;

use App\Models\Locality\City;
use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class User
 * @package App\Models
 *
 * @property string verify_token
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;

    /**
     *
     */
    public const STATUS_WAIT = 'wait';

    /**
     *
     */
    public const STATUS_ACTIVE = 'active';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'contact_name',
        'email',
        'password',
        'telephone',
        'photo',
        'city_id',
        'verify_status',
        'verify_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return BelongsToMany
     */
    public function adverts(): BelongsToMany
    {
        return $this->belongsToMany(Advert::class);
    }

    /**
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     *
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmail());
    }

    /**
     * Determine if the user has verified their email address.
     *
     * @return bool
     */
    public function hasVerifiedEmail(): bool
    {
        return $this->verify_status === self::STATUS_ACTIVE;
    }

    /**
     * @return bool
     */
    public function hasWaitVerified(): bool
    {
        return $this->verify_status === self::STATUS_WAIT;
    }

    /**
     *
     */
    public function verify(): void
    {
        $this->update([
            'verify_token' => null,
            'verify_status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     *
     */
    public function refreshToken(): void
    {
        $this->update([
            'verify_token' => self::generateToken(),
            'verify_status' => self::STATUS_WAIT,
        ]);
    }

    /**
     * @param array $data
     * @return User
     */
    public static function make(array $data): User
    {
        return self::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => self::hashPassword($data['password']),
            'verify_status' => self::STATUS_WAIT,
            'verify_token' => self::generateToken(),
        ]);
    }

    /***
     * @return string
     */
    protected static function generateToken(): string
    {
        return Str::random(20);
    }

    /**
     * @param string $password
     * @return string
     */
    public static function hashPassword(string $password): string
    {
        return Hash::make($password);
    }
}
