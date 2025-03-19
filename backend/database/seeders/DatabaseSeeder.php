<?php

namespace Database\Seeders;

use App\Modules\Customers\Models\Customer;
use App\Modules\Notifications\Models\Notification;
use App\Modules\Users\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (app()->environment('production')) {
            return;
        }

        if (false === User::where('email', env('DEFAULT_USER_EMAIL'))->exists()) {
            User::factory(1)->create([
                'name'  => 'Default User',
                'email'    => env('DEFAULT_USER_EMAIL'),
                'password' => bcrypt(env('DEFAULT_USER_PASSWORD')),
            ]);
        }

        User::factory(10)->create();

        Customer::factory(20)->create();

        Notification::factory(50)->create();

        //@todo maybe transfer it to a config file
        $roles = [
            'admin',
            'manager',
            'user',
            'guest',
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
                'guard' => 'web',
            ]);
        }

        foreach (App::getModules() as $name => $module) {
            foreach (App::make($module)->getPermissions() as $permission) {
                Permission::create([
                    'name' => $permission->value . ' ' . strtolower($name),
                    'guard_name' => 'web',
                ]);
            }
        }

        //@todo continue with roles and permissions and assign them to users
    }
}
