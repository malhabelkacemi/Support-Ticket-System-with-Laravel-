<?php

namespace Database\Factories;

use App\Helpers\OpenAIHelper;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        //$content = OpenAIHelper::generateTicketTitleAndMessage();
        $titleAndMessages = [
    [
        'title' => 'Unable to log in to the application',
        'message' => 'I cannot log in to my account. I have checked my password several times, but the system still says that my credentials are incorrect.',
    ],
    [
        'title' => 'Application crashes when opening the dashboard',
        'message' => 'The application closes unexpectedly whenever I try to open the dashboard. The problem started after the latest update.',
    ],
    [
        'title' => 'Internet connection is very slow',
        'message' => 'The internet connection has been extremely slow since this morning. Other users in the office are experiencing the same problem.',
    ],
    [
        'title' => 'Password reset email not received',
        'message' => 'I requested a password reset, but I have not received the email. I have also checked my spam folder.',
    ],
    [
        'title' => 'Printer is not responding',
        'message' => 'The office printer is connected to the network, but documents remain in the print queue and nothing is printed.',
    ],
    [
        'title' => 'User does not have access to the shared folder',
        'message' => 'I need access to the shared project folder, but I receive an access denied message when I try to open it.',
    ],
    [
        'title' => 'Error while uploading a file',
        'message' => 'The file upload fails every time. The file is within the allowed size limit, but the application displays an upload error.',
    ],
    [
        'title' => 'Database connection error',
        'message' => 'The application cannot connect to the database. Users are currently unable to access the main features of the system.',
    ],
    [
        'title' => 'Application is running very slowly',
        'message' => 'The application takes several minutes to load pages and process requests. This started today and affects multiple users.',
    ],
    [
        'title' => 'Incorrect user permissions',
        'message' => 'My account has access to functions that I should not be able to use. Could you please check my permissions?',
    ],
    [
        'title' => 'Email messages are not being sent',
        'message' => 'I can receive emails normally, but messages remain in the outbox and are not being sent.',
    ],
    [
        'title' => 'Cannot connect to the company Wi-Fi',
        'message' => 'My laptop cannot connect to the company Wi-Fi network. I have restarted the computer, but the problem remains.',
    ],
    [
        'title' => 'Incorrect data displayed in the dashboard',
        'message' => 'The dashboard is showing incorrect sales figures for yesterday. Could you please check the data and the database records?',
    ],
    [
        'title' => 'Software installation failed',
        'message' => 'I tried to install the required software, but the installation stops with an error before it is completed.',
    ],
    [
        'title' => 'Account has been locked',
        'message' => 'My account appears to be locked after several unsuccessful login attempts. I need help unlocking it.',
    ],
    [
        'title' => 'Monitor suddenly stopped working',
        'message' => 'My external monitor stopped displaying an image. I checked the cables and restarted the computer, but the issue continues.',
    ],
    [
        'title' => 'Unable to access the reporting system',
        'message' => 'I cannot access the reporting system even though my username and password are correct. The page displays an authorization error.',
    ],
    [
        'title' => 'System update caused application errors',
        'message' => 'Several errors started appearing after the latest system update. The application was working correctly before the update.',
    ],
    [
        'title' => 'Missing records in the customer database',
        'message' => 'Some customer records are no longer visible in the application. Could you please check whether the data is still available in the database?',
    ],
    [
        'title' => 'Request for access to a new application',
        'message' => 'I need access to the new project management application because I have recently joined the project team.',
    ],
];
        $ticket = fake()->randomElement($titleAndMessages);

        return [
           'created_by' => User::where('role', 'user')
                ->inRandomOrder()
                ->first()
                ->id,

            'assigned_to' => User::where('role', 'agent')
                ->inRandomOrder()
                ->first()
                ->id,

            'category_id' => Category::inRandomOrder()
                ->first()
                ->id,

            //'title' => fake()->sentence(6), // 'title' => $content['title'],
             'title' => $ticket['title'],
             'message' => $ticket['message'],


            'status' => fake()->randomElement([
                'open',
                'in_progress',
                'archived',
                'closed',
            ]),

            'priority' => fake()->randomElement([
                'low',
                'medium',
                'high',
                'urgent',
            ]),
        ];
    }
}
