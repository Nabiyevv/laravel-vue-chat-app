<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Message::class;

    public function definition(): array
    {
        return [
            //
            'conversation_id' => Conversation::inRandomOrder()->first()->id,
            'sender_id' => User::inRandomOrder()->first()->id,
            'message' => $this->faker->sentence,
            'is_read' => true,
            'is_deleted' => false,
        ];
    }
}
