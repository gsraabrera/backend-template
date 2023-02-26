<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Ronald Abrera',
            'email' => 'raabrera@up.edu.ph',
            'password' => bcrypt('123456'),
        ]);
        $user->assignRole('Admin');
    }
}
