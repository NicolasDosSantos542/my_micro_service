<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::factory(Message::class)
        ->count(50)
        ->create();
    }
}