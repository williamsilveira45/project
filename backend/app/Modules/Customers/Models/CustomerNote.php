<?php
declare(strict_types=1);

namespace App\Modules\Customers\Models;

use App\Modules\Customers\Enum\CustomerNoteTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * CustomerNote
 *
 * @property int $id
 * @property int $customer_id
 * @property string $note
 * @property CustomerNoteTypeEnum $type
 * @property int|null $created_by
 * @property string $created_at
 * @property string $updated_at
 *
 */
class CustomerNote extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => CustomerNoteTypeEnum::class,
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
