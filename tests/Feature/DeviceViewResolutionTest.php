<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeviceViewResolutionTest extends TestCase
{
    use RefreshDatabase;

    public function test_desktop_user_agent_renders_desktop_view(): void
    {
        Student::factory()->count(2)->create();

        $response = $this->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
        ])->get('/students');

        $response->assertStatus(200);
        $response->assertViewIs('routes.students.index');
        $response->assertSee('Master Data Siswa (Desktop View)');
        $response->assertSee('Pola Desktop Component');
    }

    public function test_mobile_user_agent_renders_mobile_view(): void
    {
        Student::factory()->count(2)->create();

        $response = $this->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148',
        ])->get('/students');

        $response->assertStatus(200);
        $response->assertViewIs('routes.students.index');
        $response->assertSee('Pola Mobile Component');
        $response->assertSee('fab-add');
    }

    public function test_device_query_parameter_overrides_user_agent(): void
    {
        $response = $this->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
        ])->get('/students?device=mobile');

        $response->assertStatus(200);
        $response->assertSee('Pola Mobile Component');
        $this->assertEquals('mobile', session('device_override'));
    }

    public function test_device_switch_route_sets_session_and_redirects(): void
    {
        $response = $this->from('/students')->get('/switch-device/mobile');

        $response->assertRedirect('/students');
        $this->assertEquals('mobile', session('device_override'));

        $resetResponse = $this->from('/students')->get('/switch-device/auto');
        $resetResponse->assertRedirect('/students');
        $this->assertNull(session('device_override'));
    }
}
