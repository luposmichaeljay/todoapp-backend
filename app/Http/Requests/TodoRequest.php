<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'body' => ['required'],
            'status' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
