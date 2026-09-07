<?php

use App\Models\Task;
use App\Models\User;

test('authenticated users can create a task', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('tasks.store'), [
        'title' => 'Prepare assessment submission',
        'description' => 'Finish the README and final checks.',
        'status' => 'pending',
        'priority' => 'high',
        'due_date' => now()->addDay()->toDateString(),
    ]);

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', [
        'user_id' => $user->id,
        'title' => 'Prepare assessment submission',
    ]);
});

test('task creation validates required and constrained fields', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('tasks.store'), [
        'title' => '',
        'status' => 'unknown',
        'priority' => 'urgent',
    ]);

    $response->assertSessionHasErrors(['title', 'status', 'priority']);
});

test('users can update and delete their own tasks', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create();

    $updateResponse = $this->actingAs($user)->put(route('tasks.update', $task), [
        'title' => 'Updated task title',
        'description' => 'Updated description',
        'status' => 'completed',
        'priority' => 'medium',
        'due_date' => now()->addDay()->toDateString(),
    ]);

    $updateResponse->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'title' => 'Updated task title',
        'status' => 'completed',
    ]);

    $deleteResponse = $this->actingAs($user)->delete(route('tasks.destroy', $task));

    $deleteResponse->assertRedirect(route('tasks.index'));
    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
});

test('users cannot modify another users task', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();
    $task = Task::factory()->for($owner)->create();

    $response = $this->actingAs($otherUser)->put(route('tasks.update', $task), [
        'title' => 'Unauthorized update',
        'status' => 'pending',
        'priority' => 'low',
    ]);

    $response->assertForbidden();
    $this->assertDatabaseMissing('tasks', ['title' => 'Unauthorized update']);
});

test('task listing supports search and filters', function () {
    $user = User::factory()->create();
    Task::factory()->for($user)->create([
        'title' => 'Review Laravel assessment',
        'status' => 'completed',
        'priority' => 'high',
    ]);
    Task::factory()->for($user)->create([
        'title' => 'Unrelated task',
        'status' => 'pending',
        'priority' => 'low',
    ]);

    $response = $this->actingAs($user)->get(route('tasks.index', [
        'search' => 'Laravel',
        'status' => 'completed',
        'priority' => 'high',
    ]));

    $response->assertOk()
        ->assertSee('Review Laravel assessment')
        ->assertDontSee('Unrelated task');
});
