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
            'status' => ['required', 'integer'],
            'tags' => [new RequiredIf($this->new_tags === null), 'array'],
            'tags.*' => ['required', 'exists:tags,id'],
            'new_tags' => [new RequiredIf($this->tags === null), 'array'],
            'new_tags.*' => ['required', 'unique:tags,name'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
