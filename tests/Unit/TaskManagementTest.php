<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class TaskManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test task creation functionality.
     */
    public function testTaskCreation()
    {
        Role::create(['name' => 'admin']);
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->assertTrue($admin->hasRole('admin'));


        Role::create(['name' => 'user']);
        $user = User::factory()->create();
        $user->assignRole('user');
        $this->assertTrue($user->hasRole('user'));

        $response = $this->actingAs($admin)->post('/tasks', [
            'title' => 'Test Task',
            'description' => 'This is a test task',
            'assign_to_id' => $user->id,
            'assign_by_id' => $admin->id,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks', ['title' => 'Test Task']);
    }

    /**
     * Test task listing functionality.
     */
    public function testTaskListing()
    {
        Task::factory()->count(10)->create();

        $response = $this->get('/tasks');

        $response->assertStatus(200);
        $response->assertSeeText('Title of Task 1');
        $response->assertSeeText('Title of Task 10');
    }

    /**
     * Test statistics generation functionality.
     */
    public function testStatisticsGeneration()
    {
        $userRole   = Role::create(['name' => 'user']);
        $users      = User::factory()->count(15)->create()->each(function ($user) use ($userRole) {
            $user->assignRole($userRole);
        });

        foreach ($users as $user) {
            Task::factory()->count(rand(1, 5))->create(['assign_to_id' => $user->id]);
        }

        $user = User::first();
        Auth::login($user);
        $this->actingAs($user);

        $response = $this->get('/home');

        $response->assertStatus(200);
        $response->assertSeeText('User Name 1');
    }
}
