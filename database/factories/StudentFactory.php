<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        $classes = [
            'X Rekayasa Perangkat Lunak 1',
            'X Rekayasa Perangkat Lunak 2',
            'XI Teknik Jaringan Komputer 1',
            'XI Teknik Jaringan Komputer 2',
            'XII Pengembangan Perangkat Lunak 1',
            'XII Desain Komunikasi Visual 1',
        ];

        return [
            'nis' => (string) fake()->unique()->numberBetween(20240101, 20269999),
            'name' => fake()->name(),
            'class_grade' => fake()->randomElement($classes),
            'email' => fake()->unique()->safeEmail(),
            'phone' => '08' . fake()->numerify('##########'),
            'status' => fake()->randomElement([
                Student::STATUS_ACTIVE,
                Student::STATUS_ACTIVE,
                Student::STATUS_ACTIVE,
                Student::STATUS_INACTIVE,
                Student::STATUS_GRADUATED,
            ]),
            'address' => fake()->streetAddress() . ', ' . fake()->city(),
        ];
    }
}
