<?php

namespace App\Helpers;

use OpenAI\Laravel\Facades\OpenAI;

class OpenAIHelper
{
  public static function generateCategories(int $count): array
    {
        $response = OpenAI::responses()->create([
            'model' => 'gpt-5',
            'input' => "Generate {$count} realistic categories for a customer support ticket system.

            For each category, provide:
            - name
            - description

            Return only valid JSON in this format:
            {
                \"categories\": [
                    {
                        \"name\": \"Hardware\",
                        \"description\": \"Problems related to computers, printers and other hardware devices.\"
                    }
                ]
            }",
                    ]);

                    $data = json_decode($response->outputText, true);

                    return $data['categories'] ?? [];
            }


    public static function generateComment(): string
        {
            $response = OpenAI::responses()->create([
                'model' => 'gpt-5',
                'input' => 'Generate one realistic and natural comment for a customer support ticket.

        The comment can be written by a customer or a support agent.
        It should be short, professional and realistic.
        Return only the comment text.',
        ]);

            return trim($response->outputText);
        }


    public static function generateTicketTitleAndMessage(): array
        {
            $response = OpenAI::responses()->create([
                'model' => 'gpt-5',
                'input' => 'Generate a realistic customer support ticket.

                Return only valid JSON in this format:
                {
                    "title": "Give a Short ticket title",
                    "message": "Detailed ticket message based on the title"
                }

                The title should be short and describe a common technical or customer support problem.
                The message should be realistic, clear, and directly related to the title.
                The message should contain 2 to 4 sentences.',

                ]);
            return json_decode($response->outputText, true);
        }

    public static function generateLogs(int $count): array
        {
            $response = OpenAI::responses()->create([
                'model' => 'gpt-5',
                'input' => "Generate {$count} realistic log entries for a customer support ticket system.

        Return only valid JSON in this format:
        {
            \"logs\": [
                {
                    \"log_name\": \"Status changed\",
                    \"description\": \"The ticket status was changed from open to in_progress.\",
                    \"properties\": {
                        \"old_status\": \"open\",
                        \"new_status\": \"in_progress\"
                    }
                }
            ]
        }

        Each log should describe a realistic action such as:
        - ticket created
        - ticket assigned
        - status changed
        - priority changed
        - comment added
        - attachment uploaded
        - ticket closed

        The description should be short and professional.
        The properties should contain useful information about the action.
        Generate exactly {$count} different logs.",
            ]);

            $data = json_decode($response->outputText, true);

            return $data['logs'] ?? [];
        }

}



   /* public static function generate(string $prompt): string
    {
        $response = OpenAI::responses()->create([
            'model' => 'gpt-5',
            'input' => $prompt,
        ]);

        return $response->outputText;
    }*/
