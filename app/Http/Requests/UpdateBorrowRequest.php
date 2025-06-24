<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBorrowRequest extends FormRequest
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
            'user_id' => 'sometimes|exists:users,id',
            'start_at' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_at',
            'status' => 'sometimes|in:pending,approved,rejected',
            'quantity' => 'sometimes|integer|min:1',
        ];
    }
}
