<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversation>
 */
class ConversationFactory extends Factory
{
    protected $model = Conversation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'creator_id' => User::inRandomOrder()->first()->id,
            'last_message_id' => Message::inRandomOrder()->first()->id,
        ];
    }
}
