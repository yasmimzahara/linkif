<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Resume;
use App\Models\Course;
use App\Models\Company;
use App\Models\Address;
use App\Models\CompanyInfo;
use App\Models\StudentInfo;
use App\Models\Internship;
use App\Models\Application;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::factory()->create([
            'name' => 'Admin',
            'password' => '123456',
            'email' => 'admin@linkif.com',
            'type' => 'admin',
        ]);
        Admin::factory()->count(20)->create();

        $course = Course::factory()->create(['name' => 'Informática']);
        $student = Student::factory()->create([
            'name' => 'Yasmim',
            'password' => '123456',
            'email' => 'yasmimz@gmail.com',
        ]);
        StudentInfo::factory()->create(['student_id' => $student->id, 'course_id' => $course->id]);
        $student2 = Student::factory()->create([
            'name' => 'Mirella',
            'password' => '123456',
            'email' => 'mirellabpa@gmail.com',
        ]);
        StudentInfo::factory()->create(['student_id' => $student2->id, 'course_id' => $course->id]);
        $students = StudentInfo::factory()->count(20)->create()->pluck('student');

        $company = Company::factory()->create([
            'name' => 'BioNTech SE',
            'password' => '123456',
            'email' => 'idar-oberstein.info@biontech.de',
            'type' => 'company',
        ]);

        Resume::factory()->create([
            'description' => '<h2>Me contrate agora</h2><ul><li>Sou pika</li><li>Sou foda</li></ul>',
            'student_id' => $student->id,
        ]);
        Resume::factory()->count(20)->create();

        $courses = collect([
            $course,
            Course::factory()->create(['name' => 'Adminstração']),
            Course::factory()->create(['name' => 'Processos Fotográficos']),
            Course::factory()->create(['name' => 'Contabilidade']),
            Course::factory()->create(['name' => 'Jogos Digitais']),
            Course::factory()->create(['name' => 'Mecânica']),
        ]);

        CompanyInfo::factory()->create(['company_id' => $company->id]);
        $companies = CompanyInfo::factory()->count(20)->create()->pluck('company');

        $internship = Internship::factory()->create([
            'requirements' => 'Excel',
            'integration_agency' => 'Sei lá',
            'course_id' => $course->id,
            'title' => 'Bioinformata Engineer',
            'workload' => 20,
            'shift' => 'day',
            'description' => 'Trabalhar bastante, fazer café, limpar escritório',
            'wage' => 10_000,
            'company_id' => $company->id,
        ]);
        $internship2 = Internship::factory()->create([
            'requirements' => 'Código Morse',
            'course_id' => $course->id,
            'title' => 'Operador de telégrafo',
            'description' => 'Precisa conhecer código morse',
            'company_id' => $companies->random()->id,
            'expires_at' => new \DateTime('-80 years'),
        ]);
        Application::factory()->create([
            'student_id' => $student->id,
            'internship_id' => $internship->id,
        ]);
        $internships = Internship::factory()->count(15)->create([
            'course_id' => $course->id,
            'company_id' => $company->id,
        ]);
        foreach($companies as $company) {
            $internships->add(
                Internship::factory()->create([
                    'course_id' => $courses->random()->id,
                    'company_id' => $company->id,
                ])
            );
        }

        foreach($students as $student) {
            Application::factory()->create([
                'student_id' => $student->id,
                'internship_id' => $internship2->id,
            ]);
        }

        foreach($students as $student) {
            Application::factory()->create([
                'student_id' => $student->id,
                'internship_id' => $internships->random()->id,
            ]);
        }
    }
}
