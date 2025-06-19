<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|min:3',
            'description' => 'required|string|max:255|min:10',
            'assigned_to'=>'nullable|string|exists:users,id',
            'due_date'=>'required|date',
            'status'=>'nullable|string|in:todo,in_progress,done',
            'priority'=>'nullable|string|in:low,medium,high'
        ];
    }
}
