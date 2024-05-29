<?php
declare(strict_types=1);

namespace App\Modules\Users;

use App\Modules\AbstractModule;
use App\Modules\Users\Repositories\Contracts\UserRepositoryInterface;
use App\Modules\Users\Repositories\UserRepository;
use Illuminate\Support\Facades\App;

/**
 * @method static User CreateUserAction(CreateUserRequestData $dataRequest)
 * @method static User LoginAction(LoginRequestData $loginRequest)
 */
class UserModule extends AbstractModule
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {
    }

    /**
     * @return UserRepository
     */
    public static function repository(): UserRepository
    {
        return App::make(UserRepositoryInterface::class);
    }
}
