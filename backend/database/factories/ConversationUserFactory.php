<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConversationUser>
 */
class ConversationUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = \App\Models\ConversationUser::class;

    public function definition(): array
    {
        return [
            //
            'user_id' => User::inRandomOrder()->first()->id,
            'conversation_id' => \App\Models\Conversation::inRandomOrder()->first()->id,
        ];
    }
}
