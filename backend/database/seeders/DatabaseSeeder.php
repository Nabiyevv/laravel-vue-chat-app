<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\ConversationUser;
use App\Models\Message;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        // Conversation::factory(5)->create();
        // Message::factory(100)->create();
        // ConversationUser::factory(40)->create();
    }
}
