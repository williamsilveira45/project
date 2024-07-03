<?php
declare(strict_types=1);

namespace App\Modules\Customers\Models;

use App\Modules\Customers\Enum\CustomerPhoneTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * CustomerPhone
 *
 * @property int $id
 * @property int $customer_id
 * @property string $phone_number
 * @property CustomerPhoneTypeEnum|null $type
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $deleted_at
 */
class CustomerPhone extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'type' => CustomerPhoneTypeEnum::class,
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
