<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Subscription;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Course::factory()->count(10)->create();
        Teacher::factory()->count(5)->create();
        Student::factory()->count(20)->create()->each(function ($student) {
            Subscription::factory()->create(['student_id' => $student->id]);
        });
    }
}
