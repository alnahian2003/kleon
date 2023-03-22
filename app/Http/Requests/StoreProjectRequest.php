<?php

namespace App\Http\Requests;

use App\Enums\ProjectStatus;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() || (auth()->check() && auth()->user()->is_admin);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "title" => ["required", "max:255"],
            "description" => ["required"],
            "budget" => ["numeric", "min:5"],
            "deadline" => ["required", "date", "after:now"],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Provide a title for the project.',
            'description.required' => 'You must provide a description about the project.',
            'budget.numeric' => 'Provide a valid number.',
            'budget.min' => 'Minimum budget is $5.',
            'deadline.after' => 'Deadline must be a future date.'
        ];
    }
}
