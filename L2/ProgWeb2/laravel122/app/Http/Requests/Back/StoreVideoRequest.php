<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User ;

class StoreVideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'su';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:65535',
            'price' => 'required|numeric',
            'year' => 'required|numeric',   
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'is_published' => 'required|boolean',
        ];
    }

    public function prepareForValidation(): void{
        $this->merge([
            'is_published' => $this->has('is_published') ?? false,
        ]);
    }
}
