<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Label>
 */
class LabelFactory extends Factory
{
    public function definition(): array
    {
        $label = fake()->unique()->randomElement([
            [
                'name' => 'bug',
                'description' => 'A problem or error that needs to be fixed.',
            ],
            [
                'name' => 'frontend',
                'description' => 'Issues related to the user interface and frontend code.',
            ],
            [
                'name' => 'backend',
                'description' => 'Issues related to server-side logic and backend code.',
            ],
            [
                'name' => 'feature',
                'description' => 'A request for a new functionality or improvement.',
            ],
            [
                'name' => 'security',
                'description' => 'Issues related to security, access, or vulnerabilities.',
            ],
            [
                'name' => 'database',
                'description' => 'Issues related to database operations or data management.',
            ],
            [
                'name' => 'performance',
                'description' => 'Issues related to application speed or performance.',
            ],
            [
                'name' => 'documentation',
                'description' => 'Issues related to technical documentation.',
            ],
            [
                'name' => 'urgent',
                'description' => 'A critical issue that requires immediate attention.',
            ],
            [
                'name' => 'ui',
                'description' => 'Issues related to the visual design and user interface.',
            ],
            [
                'name' => 'testing',
                'description' => 'Issues related to testing and quality assurance.',
            ],
            [
                'name' => 'deployment',
                'description' => 'Issues related to application deployment and releases.',
            ],
            [
                'name' => 'authentication',
                'description' => 'Issues related to login and user authentication.',
            ],
            [
                'name' => 'network',
                'description' => 'Issues related to network connectivity.',
            ],
            [
                'name' => 'accessibility',
                'description' => 'Issues related to accessibility and usability.',
            ],
        ]);

        return [
            'name' => $label['name'],
            'description' => $label['description'],
            'slug' => Str::slug($label['name']),
            'is_visible' => true,
        ];
    }
}
