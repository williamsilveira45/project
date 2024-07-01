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
            self::HOME->value => __('Casa'),
            self::WORK->value => __('Trabalho'),
            self::OTHER->value => __('Outro'),
        ];
    }
}
