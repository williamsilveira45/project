<?php
declare(strict_types=1);

namespace App\Modules\Customers\Enum;

enum CustomerPhoneTypeEnum: string
{
    case PHONE = 'phone';
    case CELLPHONE = 'cellphone';
    case FAX = 'fax';

    public static function getValues(): array
    {
        return [
            self::PHONE,
            self::CELLPHONE,
            self::FAX,
        ];
    }

    public static function getLabels(): array
    {
        return [
            self::PHONE->value => __('Telefone'),
            self::CELLPHONE->value => __('Celular'),
            self::FAX->value => __('Fax'),
        ];
    }
}
