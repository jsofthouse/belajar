<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TrainingRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $heldAtRules = ['required', 'date'];
        if ($this->isMethod('POST')) {
            $heldAtRules[] = 'after:today';
        }
        return [
            'title' => 'required|max:150|min:5',
            'description' => 'nullable|max:255',
            'location' => 'required|max:255',
            'held_at' => $heldAtRules,
            'quota' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul wajib diisi.',
            'title.max' => 'Judul tidak boleh lebih dari 150 karakter.',
            'title.min' => 'Judul harus memiliki minimal 5 karakter.',
            'description.required' => 'Deskripsi harus diisi.',
            'location.required' => 'Lokasi wajib diisi.',
            'location.max' => 'Lokasi tidak boleh lebih dari 255 karakter.',
            'held_at.required' => 'Tanggal pelatihan wajib diisi.',
            'held_at.date' => 'Tanggal pelatihan harus berupa tanggal yang valid.',
            'held_at.after' => 'Tanggal pelatihan harus setelah hari ini.',
            'quota.required' => 'Kuota wajib diisi.',
            'quota.integer' => 'Kuota harus berupa angka bulat.',
            'quota.min' => 'Kuota harus minimal 1.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga tidak boleh kurang dari 0.'
        ];
    }
}
