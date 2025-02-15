<?php
declare(strict_types=1);

namespace App\Modules\Users\Data\Requests;

use Spatie\LaravelData\Data;

class GetUsersListRequestData extends Data
{
    public function __construct(
        public int $page = 1,
        public int $perPage = 50,
        public ?string $search = null,
        public ?string $sort = null,
        public ?string $order = null,
    ) {}
}
