<?php
declare(strict_types=1);

namespace App\Modules\Customers\Models;

use App\Modules\Customers\Enum\CustomerAddressTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * CustomerAddress
 *
 * @property int $id
 * @property int $customer_id
 * @property string $address_line1
 * @property string|null $address_line2
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property string $country
 * @property CustomerAddressTypeEnum|null $type
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $deleted_at
 */
class CustomerAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'type' => CustomerAddressTypeEnum::class,
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
