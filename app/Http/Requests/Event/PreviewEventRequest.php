<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class PreviewEventRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'wedding_card_id' => 'required|exists:wedding_cards,id',
            'time' => 'required|date_format:Y-m-d H:i:s',
            'location' => 'required|string|max:255',
            'groom_family' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
            'bride_family' => 'required|string|max:255',
            'bride_name' => 'required|string|max:255',
        ];
    }
}