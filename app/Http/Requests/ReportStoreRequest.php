<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportStoreRequest extends FormRequest
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
            'site_name' => ['required', 'string', 'max:20'],
            'image_path' => ['nullable', 'string', 'max:100'],
            'body' => ['required', 'max:500'],
            'user_id' => ['nullable', 'array'],
            'user_id.*' => ['required', 'numeric', 'exists:users,id'],
            'working_day' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
        ];
    }

    public function attributes(): array
    {
        return [
            'site_name' => '現場名',
            'body' => '業務内容',
            'working_day' => '作業日',
            'start_time' => '開始時間',
            'end_time' => '終了時間'
        ];
    }
}
