<?php
declare(strict_types=1);

namespace App\Modules\Notifications\Enum;

enum NotificationTypeEnum: string
{
    case INFO = 'info';
    case SUCCESS = 'success';
    case WARNING = 'warning';
    case ERROR = 'error';

    public static function getValues(): array
    {
        return [
            self::INFO,
            self::SUCCESS,
            self::WARNING,
            self::ERROR,
        ];
    }

    public static function getLabels(): array
    {
        return [
            self::INFO => __('Info'),
            self::SUCCESS => __('Success'),
            self::WARNING => __('Warning'),
            self::ERROR => __('Error'),
        ];
    }
}
