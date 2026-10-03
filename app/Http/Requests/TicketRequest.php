<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'assigned_to'=>['nullable',"exists:users,id"],
        'category_id'=>["required","exists:category,id"],
        'title'=>["required" ,"string","max:40"],
        'message'=>["required" ,"string", "min:20"],
        'status'=>['nullable',"in:open,in_progress,archived,closed"],
        'priority'=>['nullable',"in:low,medium,high,urgent"],

        'label'=>["nullable"], //globalement
        'label.*'=>["exists:labels,id"], //chaque element individuel

        'attachment'=>['nullable'], //["array"], //si l champs est rempli doit etre obligaoirement etre une array
        'attachment.*'=>["file","max:8192"], //chaque element individuel
        ];
    }
}
