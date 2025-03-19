<?php
declare(strict_types=1);

namespace App\Modules\Customers\Enum;

enum CustomerPermissionEnum: string
{
    case READ = 'read';
    case UPDATE = 'update';
    case DELETE = 'delete';
    case INSERT = 'insert';

    public static function getValues(): array
    {
        return [
            self::READ,
            self::UPDATE,
            self::DELETE,
            self::INSERT,
        ];
    }

    public static function getLabels(): array
    {
        return [
            self::READ => __('Read'),
            self::UPDATE => __('Update'),
            self::DELETE => __('Delete'),
            self::INSERT => __('Insert'),
        ];
    }
}
