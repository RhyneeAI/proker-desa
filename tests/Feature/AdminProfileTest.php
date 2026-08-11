<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_update_preserves_old_input_on_validation_error(): void
    {
        $user = User::factory()->create(['name' => 'Nama Lama', 'email' => 'lama@desa.test']);

        $response = $this->actingAs($user)
            ->from(route('admin.profile'))
            ->patch(route('admin.profile.update'), [
                'name' => 'Nama Baru',
                'email' => 'bukan-email',
            ]);

        $response->assertSessionHasErrors('email')
            ->assertRedirect(route('admin.profile'));

        $this->get(route('admin.profile'))
            ->assertOk()
            ->assertSee('value="Nama Baru"', false)
            ->assertSee('value="bukan-email"', false);
    }

    public function test_admin_can_login_with_username(): void
    {
        $user = User::factory()->create(['username' => 'admin_test', 'password' => bcrypt('password')]);

        $this->post(route('login'), [
            'identifier' => 'admin_test',
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($user);
    }
}
