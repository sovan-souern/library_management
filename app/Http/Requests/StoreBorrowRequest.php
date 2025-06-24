<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBorrowRequest extends FormRequest
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
            'user_id'  => 'required|exists:users,id',
            'start_at' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_at',
            'status'   => 'required|string|in:pending,approved,rejected,returned',
            'quantity' => 'required|integer|min:1',
        ];
    }
}
