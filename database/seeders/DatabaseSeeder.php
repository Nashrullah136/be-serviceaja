<?php

namespace Database\Seeders;

use App\Http\Middleware\Admin;
use App\Models\Catalog;
use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->phone_number = '000000000000';
        $user->password = Hash::make('admin-serviceaja');
        $user->role = User::ADMIN;
        $user->save();
        News::factory()->count(5)->otomotif()->create();
        News::factory()->count(5)->service()->create();
        Catalog::factory()->count(3)->oli()->create();
        Catalog::factory()->count(3)->sparepart()->create();
    }
}
