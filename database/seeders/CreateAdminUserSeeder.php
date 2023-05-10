<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'worker_id' => '29106122500031',
            'name' => 'Ahmed Emad',
            'email' => 'admin@app.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => '2022-03-21 09:32:44',
            'active' => '1',
        ]);
        $role = Role::create(['name' => 'Owner']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}
