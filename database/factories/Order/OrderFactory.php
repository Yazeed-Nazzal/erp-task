<?php

namespace Database\Factories\order;

use App\Models\users\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users_ids = User::all()->pluck('id')->toArray();

        return [
            'user_id' => $users_ids[mt_rand(1,count($users_ids)-1)],
            'status' => 'pending'
        ];
    }
}
