<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'admin',
            'email' => 'admin@stirling.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$GRUIDyTsoMpsfs2Eko9aFOLEINOIjZi/AJNIv20C0AnGTmVWBo.ha', // 123456
            'remember_token' => Str::random(10),
            'is_admin'=>1
        ];
    }
}
