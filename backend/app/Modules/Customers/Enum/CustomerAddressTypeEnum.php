<?php
declare(strict_types=1);

namespace App\Modules\Customers\Enum;

enum CustomerAddressTypeEnum: string
{
    case HOME = 'home';
    case WORK = 'work';
    case OTHER = 'other';

    public static function getValues(): array
    {
        return [
            self::HOME,
            self::WORK,
            self::OTHER,
        ];
    }

    public static function getLabels(): array
    {
        return [
            self::HOME->value => __('Home'),
            self::WORK->value => __('Work'),
            self::OTHER->value => __('Other'),
        ];
    }
}
