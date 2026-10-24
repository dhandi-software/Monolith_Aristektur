<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StudentService
{
    public function paginate(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        $search = $filters['search'] ?? null;
        $status = $filters['status'] ?? null;

        return Student::query()
            ->search($search)
            ->filterStatus($status)
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function find(int|string $id): Student
    {
        return Student::findOrFail($id);
    }

    public function create(array $data): Student
    {
        return Student::create($data);
    }

    public function update(Student $student, array $data): bool
    {
        return $student->update($data);
    }

    public function delete(Student $student): bool
    {
        return (bool) $student->delete();
    }

    public function getStatistics(): array
    {
        return [
            'total' => Student::count(),
            'active' => Student::where('status', Student::STATUS_ACTIVE)->count(),
            'inactive' => Student::where('status', Student::STATUS_INACTIVE)->count(),
            'graduated' => Student::where('status', Student::STATUS_GRADUATED)->count(),
        ];
    }
}
