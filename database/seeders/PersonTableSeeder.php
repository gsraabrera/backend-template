<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Person;
use Illuminate\Support\Str;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $persons = [
            [
            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'FirstName' => 'Trish',
            'MiddleName' => 'Papa',
            'LastName' => 'Daza',
            'Sex' => 'Female',
            'DateOfBirth' => '1997-08-20',
            'CivilStatus' => 'Single',
            'IsVerified' => 0,
            'IsActive' => 0,
            ],
            [
            'id' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'FirstName' => 'Ciejay',
            'MiddleName' => 'Anda',
            'LastName' => 'Pasamonte',
            'Sex' => 'Female',
            'DateOfBirth' => '1997-01-01',
            'CivilStatus' => 'Single',
            'IsVerified' => 0,
            'IsActive' => 0,
            ],
        ];
        Person::insert($persons);
    }
}
