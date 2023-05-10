<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Company;
use App\Models\Country;
use App\Models\Location;
use App\Models\ViolationType;
use App\Models\Vp;
use App\Models\Worker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
        ]);
        Worker::create([
            'id' => 29106122500031,
            'name' => 'ahmed emad',
            'email' => 'admin@app.com',
            'job' => 'Developer',
            'state' => 1,
        ]);
    }
}
