<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class TodoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'body' => ['required'],
            'priority' => ['required', 'in:1,2,3,4,5'],
            'status' => ['required', 'in:pending,in progress,blocked'],
            'tags' => [new RequiredIf($this->new_tags === null), 'array'],
            'tags.*' => ['required', 'exists:tags,id'],
            'new_tags' => [new RequiredIf($this->tags === null), 'array'],
            'new_tags.*' => ['required', 'unique:tags,name'],
            'due_date' => ['sometimes', 'nullable', 'date_format:Y-m-d'],
            'date_completed' => ['sometimes', 'nullable', 'date_format:Y-m-d'],
            'archived' => ['sometimes', 'nullable', 'date_format:Y-m-d'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
