<?php
declare(strict_types=1);

namespace App\Modules\Customers\Enum;

enum CustomerNoteTypeEnum: string
{
    case GENERAL = 'general';
    case INTERNAL = 'internal';


    public static function getValues(): array
    {
        return [
            self::GENERAL,
            self::INTERNAL,
        ];
    }

    public static function getLabels(): array
    {
        return [
            self::GENERAL->value => __('Geral'),
            self::INTERNAL->value => __('Interno'),
        ];
    }
}
