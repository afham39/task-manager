<?php

use App\Models\Task;
use App\Models\User;

test('guests are redirected to the login page', function () {
    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('login'));
});

test('authenticated users can visit the dashboard', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('dashboard'));
    $response->assertOk();
});

test('dashboard displays the authenticated users task summary', function () {
    $user = User::factory()->create();
    Task::factory()->for($user)->create(['status' => 'pending']);
    Task::factory()->for($user)->create(['status' => 'completed']);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertOk()
        ->assertSee('Task Dashboard')
        ->assertSee('2')
        ->assertSee('Recent tasks');
});
