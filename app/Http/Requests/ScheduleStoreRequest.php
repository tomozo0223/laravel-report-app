<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleStoreRequest extends FormRequest
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
            'site_id' => ['required', 'string', 'exists:sites,id'],
            'member_id' => ['required', 'array'],
            'working_day' => ['required', 'date', 'after:today'],
            'work_details' => ['required', 'string', 'max:100'],
        ];
    }

    public function attributes(): array
    {
        return [
            'site_id' => '現場',
            'member_id' => 'メンバー',
            'working_day' => '作業日',
            'work_details' => '作業内容',
        ];
    }
}
