<?php
declare(strict_types=1);

namespace App\Modules\Users\Actions;

use App\Modules\Users\Models\User;
use Illuminate\Support\Facades\DB;

class LogoutAction
{
    public function execute(User $user): bool
    {
        if ('database' === config('session.driver')) {
            DB::table('sessions')->where('user_id', $user->getKey())->delete();
        }

        return false;
    }
}
