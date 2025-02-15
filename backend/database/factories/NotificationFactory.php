<?php

namespace Database\Factories;

use App\Modules\Notifications\Enum\NotificationTypeEnum;
use App\Modules\Notifications\Models\Notification;
use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        return [
            'from_user_id' => User::factory(),
            'to_user_id' => User::factory(),
            'title' => $this->faker->sentence(),
            'type' => $this->faker->randomElement(NotificationTypeEnum::cases()),
            'content' => $this->faker->paragraph(),
            'is_read' => $this->faker->boolean(),
            'read_at' => $this->faker->dateTime(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
