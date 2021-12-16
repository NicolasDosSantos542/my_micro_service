<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'message' => $this->faker->text($maxNbChars = 200) ,
            'transmitter_id' => $this->faker->numberBetween($min = 1, $max = 50),
            'receiver_id'=>$this->faker->numberBetween($min = 1, $max = 50),
            'created_at' => $this->faker->dateTimeThisDecade(),
            'updated_at' => $this->faker->dateTimeThisYear()
            
        ];
    }
}
