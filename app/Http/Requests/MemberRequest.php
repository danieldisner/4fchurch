<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
        $memberId = $this->route('member') ? $this->route('member')->id : null;

        return [
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|unique:members,cpf,' . $memberId,
            'rg' => 'required|string|unique:members,rg,' . $memberId,
            'email' => 'nullable|email|max:255|unique:members,email,' . $memberId,
            'phone' => 'nullable|string|max:15',
            'whatsapp' => 'nullable|string|max:15',
            'address_zipcode' => 'nullable|string|max:10',
            'address_street' => 'nullable|string|max:255',
            'address_number' => 'nullable|string|max:10',
            'address_neighborhood' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'uf' => 'nullable|string|size:2',
            'birthdate' => 'nullable|date',
            'joined_at' => 'nullable|date',
            'status_id' => 'required|exists:statuses,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'baptism_date' => 'nullable|date',
            'profession' => 'nullable|string|max:255',
        ];
    }
}
