<?php
declare(strict_types=1);

namespace App\Modules\Customers\Models;

use App\Modules\Customers\Enum\CustomerStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Customer
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $cpf
 * @property string $rg
 * @property CustomerStatusEnum $status
 * @property string $birth_date
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 */
class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'status' => CustomerStatusEnum::class,
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function phones(): HasMany
    {
        return $this->hasMany(CustomerPhones::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(CustomerNotes::class);
    }
}
