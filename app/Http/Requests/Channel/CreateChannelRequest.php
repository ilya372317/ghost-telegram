<?php

namespace App\Http\Requests\Channel;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateChannelRequest
 * @pakege App\Http\Requests\Channel
 *
 * @author Otinov Ilya
 */
class CreateChannelRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'userName' => 'required|string|unique:channels,username',
        ];
    }
}
