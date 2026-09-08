<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
    }

    public function test_super_admin_can_view_user_management_and_monitoring_page(): void
    {
        $superAdmin = User::where('email', 'superadmin@pkbm.id')->first();

        $response = $this->actingAs($superAdmin)->get(route('admin.users.index'));

        $response->assertStatus(200);
        $response->assertSee('Kelola Akun & Monitoring Sistem');
        $response->assertSee('superadmin@pkbm.id');
        $response->assertSee('admin@pkbm.id');
    }

    public function test_regular_admin_cannot_access_user_management(): void
    {
        $admin = User::where('email', 'admin@pkbm.id')->first();

        $response = $this->actingAs($admin)->get(route('admin.users.index'));

        $response->assertStatus(403);
    }

    public function test_super_admin_can_create_new_admin_user(): void
    {
        $superAdmin = User::where('email', 'superadmin@pkbm.id')->first();

        $response = $this->actingAs($superAdmin)->post(route('admin.users.store'), [
            'name' => 'Petugas Baru PKBM',
            'email' => 'petugasbaru@pkbm.id',
            'password' => 'password123',
            'role' => 'admin',
        ]);

        $response->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', [
            'email' => 'petugasbaru@pkbm.id',
            'name' => 'Petugas Baru PKBM',
        ]);

        $newUser = User::where('email', 'petugasbaru@pkbm.id')->first();
        $this->assertTrue($newUser->hasRole('admin'));
    }

    public function test_super_admin_cannot_delete_self(): void
    {
        $superAdmin = User::where('email', 'superadmin@pkbm.id')->first();

        $response = $this->actingAs($superAdmin)->delete(route('admin.users.destroy', $superAdmin));

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('users', ['id' => $superAdmin->id]);
    }
}
