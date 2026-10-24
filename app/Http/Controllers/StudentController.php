<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(
        protected StudentService $studentService
    ) {}

    public function index(Request $request): View
    {
        $filters = $request->only(['search', 'status']);
        $students = $this->studentService->paginate($filters, 10);
        $statistics = $this->studentService->getStatistics();

        return view('routes.students.index', compact('students', 'statistics', 'filters'));
    }

    public function create(): View
    {
        return view('routes.students.create');
    }

    public function store(StoreStudentRequest $request): RedirectResponse
    {
        $this->studentService->create($request->validated());

        return redirect()
            ->route('students.index')
            ->with('success', 'Data siswa baru berhasil disimpan.');
    }

    public function show(Student $student): View
    {
        return view('routes.students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        return view('routes.students.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, Student $student): RedirectResponse
    {
        $this->studentService->update($student, $request->validated());

        return redirect()
            ->route('students.index')
            ->with('success', 'Perubahan data siswa berhasil diperbarui.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $this->studentService->delete($student);

        return redirect()
            ->route('students.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}
