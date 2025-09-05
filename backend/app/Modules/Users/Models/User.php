<?php
declare(strict_types=1);

namespace App\Modules\Users\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Modules\Notifications\Models\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use William\EncryptModel\EncryptModel;

/**
 * User class
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $email_verified_at
 * @property string|null $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, EncryptModel, HasRoles;

    /**
     * Attributes that should be encrypted
     * @var array<int, string>
     */
    protected $encryptable = [
        'name',
        'email',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function newFactory()
    {
        return \Database\Factories\UserFactory::new();
    }

    public function setPassword(string $password): void
    {
        $this->password = Hash::make($password);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'to_user_id');
    }

    public function notificationsSent(): HasMany
    {
        return $this->hasMany(Notification::class, 'from_user_id');
    }
}
