<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_root_redirects_to_students_index(): void
    {
        $response = $this->get('/');
        $response->assertRedirect('/students');
    }

    public function test_can_list_students(): void
    {
        Student::factory()->count(3)->create();

        $response = $this->get('/students');

        $response->assertStatus(200);
        $response->assertViewHas('students');
        $response->assertViewHas('statistics');
    }

    public function test_can_render_create_page(): void
    {
        $response = $this->get('/students/create');

        $response->assertStatus(200);
        $response->assertSee('Nomor Induk Siswa (NIS)');
    }

    public function test_can_store_student_with_valid_data(): void
    {
        $payload = [
            'nis' => '20261001',
            'name' => 'Budi Santoso',
            'class_grade' => 'XII RPL 1',
            'email' => 'budi.santoso@sekolah.sch.id',
            'phone' => '08123456789',
            'status' => 'active',
            'address' => 'Jl. Pendidikan No. 45, Jakarta',
        ];

        $response = $this->post('/students', $payload);

        $response->assertRedirect('/students');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('students', [
            'nis' => '20261001',
            'email' => 'budi.santoso@sekolah.sch.id',
        ]);
    }

    public function test_validation_fails_when_required_fields_are_missing(): void
    {
        $response = $this->post('/students', []);

        $response->assertSessionHasErrors(['nis', 'name', 'class_grade', 'email', 'status']);
    }

    public function test_validation_fails_for_duplicate_nis(): void
    {
        Student::factory()->create(['nis' => '20260001']);

        $response = $this->post('/students', [
            'nis' => '20260001',
            'name' => 'Duplikat Siswa',
            'class_grade' => 'X RPL 1',
            'email' => 'new@sekolah.sch.id',
            'status' => 'active',
        ]);

        $response->assertSessionHasErrors(['nis']);
    }

    public function test_can_show_student_detail(): void
    {
        $student = Student::factory()->create(['name' => 'Rina Wijaya']);

        $response = $this->get("/students/{$student->id}");

        $response->assertStatus(200);
        $response->assertSee('Rina Wijaya');
    }

    public function test_can_update_student(): void
    {
        $student = Student::factory()->create([
            'nis' => '20265555',
            'name' => 'Nama Lama',
        ]);

        $payload = [
            'nis' => '20265555',
            'name' => 'Nama Baru Diperbarui',
            'class_grade' => 'XII RPL 2',
            'email' => $student->email,
            'status' => 'active',
        ];

        $response = $this->put("/students/{$student->id}", $payload);

        $response->assertRedirect('/students');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => 'Nama Baru Diperbarui',
        ]);
    }

    public function test_can_delete_student(): void
    {
        $student = Student::factory()->create();

        $response = $this->delete("/students/{$student->id}");

        $response->assertRedirect('/students');
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('students', [
            'id' => $student->id,
        ]);
    }
}
