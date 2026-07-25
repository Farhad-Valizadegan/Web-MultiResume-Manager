<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_an_active_user(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);

        $response = $this
            ->actingAs($admin)
            ->post(route('admin.users.store'), [
                'name' => 'Active User',
                'email' => 'active@example.com',
                'password' => 'password123',
                'role' => 'user',
                'status' => 'active',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHas('success', 'User created successfully.');

        $this->assertDatabaseHas('users', [
            'name' => 'Active User',
            'email' => 'active@example.com',
            'role' => 'user',
            'status' => 'active',
        ]);
    }

    public function test_admin_can_create_an_inactive_user(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);

        $response = $this
            ->actingAs($admin)
            ->post(route('admin.users.store'), [
                'name' => 'Inactive User',
                'email' => 'inactive@example.com',
                'password' => 'password123',
                'role' => 'user',
                'status' => 'inactive',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHas('success', 'User created successfully.');

        $this->assertDatabaseHas('users', [
            'name' => 'Inactive User',
            'email' => 'inactive@example.com',
            'role' => 'user',
            'status' => 'inactive',
        ]);
    }

    public function test_admin_can_update_a_users_status(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);

        $user = User::factory()->create([
            'role' => 'user',
            'status' => 'inactive',
        ]);

        $response = $this
            ->actingAs($admin)
            ->put(route('admin.users.update', $user), [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'status' => 'active',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHas('success', 'User updated successfully.');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'status' => 'active',
        ]);
    }

    public function test_admin_can_deactivate_another_user(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);

        $user = User::factory()->create([
            'role' => 'user',
            'status' => 'active',
        ]);

        $response = $this
            ->actingAs($admin)
            ->patch(route('admin.users.deactivate', $user));

        $response
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHas('success', 'User deactivated successfully.');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'status' => 'inactive',
        ]);
    }

    public function test_admin_cannot_deactivate_their_own_account(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);

        $response = $this
            ->actingAs($admin)
            ->patch(route('admin.users.deactivate', $admin));

        $response
            ->assertRedirect(route('admin.users.index'))
            ->assertSessionHas(
                'error',
                'You cannot deactivate your own account.'
            );

        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'status' => 'active',
        ]);
    }

    public function test_invalid_user_status_is_rejected(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'active',
        ]);

        $response = $this
            ->actingAs($admin)
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), [
                'name' => 'Invalid Status User',
                'email' => 'invalid-status@example.com',
                'password' => 'password123',
                'role' => 'user',
                'status' => 'blocked',
            ]);

        $response
            ->assertRedirect(route('admin.users.create'))
            ->assertSessionHasErrors('status');

        $this->assertDatabaseMissing('users', [
            'email' => 'invalid-status@example.com',
        ]);
    }
}