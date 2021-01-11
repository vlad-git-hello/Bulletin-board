<?php

declare(strict_types=1);

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserEditRequest
 * @package App\Http\Requests\Profile
 */
class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users,id,' . $this->user->id,
            'password' => 'nullable|string|min:8',
            'telephone' => 'required|phone_number',
            'city_id' => 'required|integer',
            'photo' => 'nullable|mimes:jpeg,jpg,png',
        ];
    }

    /**
     * Get custom messages for validator error.
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'telephone.phone_number' => 'Invalid phone number.'
        ];
    }


}
