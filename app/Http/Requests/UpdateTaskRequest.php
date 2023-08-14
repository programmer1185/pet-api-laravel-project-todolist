<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\DTO\UpdateTaskDto;
use Illuminate\Support\Facades\Auth;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string',
            'priority' => 'sometimes|between:1,5',
            'description' => 'sometimes|string',
        ];
    }

    /**
     * @return UpdateTaskDto
     */
    public function getDto(): UpdateTaskDto
    {
        return new UpdateTaskDto($this->title, $this->priority, $this->description);
    }
}
