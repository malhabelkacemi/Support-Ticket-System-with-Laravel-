<?php

namespace Database\Factories;

use App\Models\Attachment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attachment>
 */
class AttachmentFactory extends Factory
{
    protected $model = Attachment::class;

    public function definition(): array
    {
        $fileType = fake()->randomElement([
            'image',
            'pdf',
            'video',
        ]);

        $extension = match ($fileType) {
            'image' => fake()->randomElement(['jpg', 'png', 'jpeg']),
            'pdf' => 'pdf',
            'video' => fake()->randomElement(['mp4', 'mov']),
        };

        $fileName = fake()->unique()->words(2, true) . '.' . $extension;

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'ticket_id' => Ticket::inRandomOrder()->first()->id,
            'file_name' => $fileName,
            'file_path' => 'attachments/' . $fileName,
            'file_type' => $fileType,
            'size' => fake()->numberBetween(100, 20000), // for example : between 100 Ko and 20 000 Ko (≈ 20 Mo).
        ];
    }
}
