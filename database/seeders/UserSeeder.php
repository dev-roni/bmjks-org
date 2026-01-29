<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder {
    public function run(): void{
        User::insert([
            [
                "name"         => "Super Admin",
                "username"     => "bmjkssuperadmin",
                "phone_no"     => "0171000001",
                "account_type" => "superadmin",
                "branch"       => "100",
                "password"     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                "name"         => "Cashier",
                "username"     => "bmjkscashier",
                "phone_no"     => "0172000000",
                "account_type" => "cashier",
                "branch"       => "99",
                "password"     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                "name"         => "Admin",
                "username"     => "bmjkscentraladmin",
                "phone_no"     => "0173000000",
                "account_type" => "admin",
                "branch"       => "1",
                "password"     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                "name"         => "Admin",
                "username"     => "bmjksbaligaonadmin",
                "phone_no"     => "0174000000",
                "account_type" => "admin",
                "branch"       => "2",
                "password"     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                "name"         => "Admin",
                "username"     => "bmjksmadhobpuradmin",
                "phone_no"     => "0175000000",
                "account_type" => "admin",
                "branch"       => "3",
                "password"     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                "name"         => "Admin",
                "username"     => "bmjksghuramaraadmin",
                "phone_no"     => "0176000000",
                "account_type" => "admin",
                "branch"       => "4",
                "password"     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                "name"         => "Admin",
                "username"     => "bmjkstilokpuradmin",
                "phone_no"     => "0177000000",
                "account_type" => "admin",
                "branch"       => "5",
                "password"     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                "name"         => "Admin",
                "username"     => "bmjksbhanubiladmin",
                "phone_no"     => "0178000000",
                "account_type" => "admin",
                "branch"       => "6",
                "password"     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                "name"         => "Admin",
                "username"     => "bmjksadompuradmin",
                "phone_no"     => "0179000000",
                "account_type" => "admin",
                "branch"       => "7",
                "password"     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                "name"         => "Admin",
                "username"     => "bmjksdaluaadmin",
                "phone_no"     => "0171100000",
                "account_type" => "admin",
                "branch"       => "8",
                "password"     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                "name"         => "Admin",
                "username"     => "bmjksgulerhaoradmin",
                "phone_no"     => "0171200000",
                "account_type" => "admin",
                "branch"       => "9",
                "password"     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                "name"         => "Admin",
                "username"     => "bmjksmashimpuradmin",
                "phone_no"     => "0171300000",
                "account_type" => "admin",
                "branch"       => "10",
                "password"     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                "name"         => "Admin",
                "username"     => "bmjksdhonitilaadmin",
                "phone_no"     => "0171400000",
                "account_type" => "admin",
                "branch"       => "11",
                "password"     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                "name"         => "Admin",
                "username"     => "bmjksmajhergaonadmin",
                "phone_no"     => "0171500000",
                "account_type" => "admin",
                "branch"       => "12",
                "password"     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                "name"         => "Admin",
                "username"     => "bmjksbishgaonadmin",
                "phone_no"     => "0171600000",
                "account_type" => "admin",
                "branch"       => "13",
                "password"     => Hash::make('12345678'),
                'created_at'   => now(),
                'updated_at'   => now()
            ],
        ]);
    }
}
