<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\DTO\CreateTaskDto;
use Illuminate\Support\Facades\Auth;

class CreateTaskRequest extends FormRequest
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
            'title' => 'required',
            'priority' => ['required', 'between:1,5'],
            'description' => 'required',
            'parent_id' => 'sometimes|exists:tasks,id'
        ];
    }

    /**
     * @return CreateTaskDto
     */
    public function getDto(): CreateTaskDto
    {
        return new CreateTaskDto(
            $this->title,
            $this->priority,
            $this->description,
            $this->parent_id
        );
    }
}
