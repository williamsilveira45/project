<?php
declare(strict_types=1);

namespace App\Modules\Customers\Enum;

enum CustomerStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public static function getValues(): array
    {
        return [
            self::ACTIVE,
            self::INACTIVE,
        ];
    }

    public static function getLabels(): array
    {
        return [
            self::ACTIVE->value => __('Active'),
            self::INACTIVE->value => __('Inactive'),
        ];
    }
}
