<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'assignee_id' => 'bail|exists:users,id',
            'type_id' => 'bail|exists:task_types,id',
            'task_parent_id' => 'bail|exists:tasks,id',
            'project_id' => 'bail|exists:projects,id'
        ];
    }
}
