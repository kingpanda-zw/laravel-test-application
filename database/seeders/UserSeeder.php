<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $administrator = User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$J1CC3VOn2tDY1OWzcdBEl.BZ6Yxr7bhaqLsgaUy50oD79U0s9ODOq',
        ]);
    }
}
