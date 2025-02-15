<?php
declare(strict_types=1);

namespace App\Modules\Notifications\Models;

use App\Modules\Notifications\Enum\NotificationTypeEnum;
use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Notification
 * @property int $id
 * @property int $from_user_id
 * @property int $to_user_id
 * @property string $title
 * @property NotificationTypeEnum $type
 * @property string $content
 * @property bool $is_read
 * @property \Carbon\Carbon $read_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Models\User $fromUser
 * @property-read \App\Models\User $toUser
 */
class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'type' => NotificationTypeEnum::class,
        'is_read' => 'boolean',
    ];

    protected static function newFactory()
    {
        return \Database\Factories\NotificationFactory::new();
    }

    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}
