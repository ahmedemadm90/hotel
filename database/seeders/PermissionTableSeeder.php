<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Workers','Worker Show','Worker Create','Worker Edit','Worker Delete',
            'Customers','Customer Show','Customer Create','Customer Edit','Customer Delete',
            'Rooms','Room Show','Room Create','Room Edit','Room Delete',
            'Cards','Card Show','Card Create','Card Edit','Card Delete',
            'Reservations','Reservation Show','Reservation Create','Reservation Edit','Reservation Delete','Reservation Checkout','Reservation Bill',
            'Menu Categories','Menu Category Show','Menu Category Create','Menu Category Edit','Menu Category Delete',
            'Menu Types','Menu Type Show','Menu Type Create','Menu Type Edit','Menu Type Delete',
            'Orders','Order Show','Order Create','Order Edit','Order Delete',
            'Room Services','Room Service Show','Room Service Create','Room Service Edit','Room Service Delete','Room Service Done',
            'Transactions', 'Transaction Show', 'Transaction Create', 'Transaction Edit', 'Transaction Delete',
            'Roles','Role Show','Role Create','Role Edit','Role Delete',
            'Users','User Show','User Create','User Edit','User Delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
