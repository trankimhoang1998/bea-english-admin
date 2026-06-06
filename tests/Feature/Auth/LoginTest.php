<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_renders(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_manager_redirected_to_manager_dashboard_after_login(): void
    {
        $user = User::factory()->manager()->create();
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $response->assertRedirect('/manager/dashboard');
    }

    public function test_teacher_redirected_to_teacher_dashboard_after_login(): void
    {
        $user = User::factory()->teacher()->create();
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $response->assertRedirect('/teacher/dashboard');
    }

    public function test_student_redirected_to_student_dashboard_after_login(): void
    {
        $user = User::factory()->student()->create();
        $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
        $response->assertRedirect('/student/dashboard');
    }
}
