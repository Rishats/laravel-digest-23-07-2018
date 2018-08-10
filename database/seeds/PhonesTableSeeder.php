<?php

use Illuminate\Database\Seeder;
use App\User;

class PhonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phones')->insert([
            'user_id' => 1,
            'phone_number' => '+' . rand(1111111111,9999999999),
        ]);
    }
}
