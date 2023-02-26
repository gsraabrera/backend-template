<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert([
            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'acronym' => Str::random(5),
            'name' => Str::random(12)
        ]);
    }
}
