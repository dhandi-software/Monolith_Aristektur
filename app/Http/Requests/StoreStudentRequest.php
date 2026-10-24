<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nis' => ['required', 'string', 'max:20', 'unique:students,nis'],
            'name' => ['required', 'string', 'max:100'],
            'class_grade' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:100', 'unique:students,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'status' => ['required', Rule::in([Student::STATUS_ACTIVE, Student::STATUS_INACTIVE, Student::STATUS_GRADUATED])],
            'address' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'nis.required' => 'Nomor Induk Siswa (NIS) wajib diisi.',
            'nis.unique' => 'NIS ini sudah terdaftar.',
            'name.required' => 'Nama lengkap siswa wajib diisi.',
            'class_grade.required' => 'Kelas / Jurusan wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan oleh siswa lain.',
            'status.required' => 'Status siswa wajib dipilih.',
            'status.in' => 'Status siswa yang dipilih tidak valid.',
        ];
    }
}
