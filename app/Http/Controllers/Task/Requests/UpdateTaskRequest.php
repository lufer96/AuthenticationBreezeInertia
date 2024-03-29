<?php

namespace App\Http\Controllers\Task\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->task);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Example unique'uuid_key' => ['required', Rule::unique('task')->ignore($this->task->id)],
            'name' => 'required|max:255',
            'description' => 'max:255',
            'status' => 'required|boolean',
        ];
    }
}
