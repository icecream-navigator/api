<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Rate;
use App\Models\User;
use App\Models\Stall;
use JWTAuth;


class RateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;


    /** @test */
    public function admins_cant_rate()
    {
        $admin = User::factory()->create([
            'is_admin' => 1,
        ]);

        $stall = Stall::factory()->create([
            'id'      => 1,
            'user_id' => $admin->id,
            'owner'   => $admin->name,
        ]);

        $rate = Rate::factory()->definition([
            'user_id'  => $admin->id,
            'stall_id' => $stall->id,
        ]);

        $response = $this->actingAsUser($admin)->post('api/stall/rate/1', $rate);

        $response
            ->assertStatus(403);

    }

    /** @test */
    public function rate_cannot_be_noninteger()
    {

        $user = User::factory()->create([
            'is_admin' => 0,
        ]);

        $admin = User::factory()->create([
            'is_admin' => 1,
        ]);

        $stall = Stall::factory()->create([
            'id'      => 1,
            'user_id' => $admin->id,
            'owner'   => $admin->name,
        ]);

        $rate = Rate::factory()->definition([
            'user_id'  => $user->id,
            'stall_id' => $stall->id,
            'rate' => 4.23
        ]);

        $response = $this->actingAsUser($user)->post('api/stall/rate/1', $rate);

        $response
            ->assertStatus(422);
    }

    public function actingAsUser($user, $driver = null)
    {
        $token = JWTAuth::fromUser($user);

        $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'multipart/form-data',
            'Authorization' => "Bearer {$token}"

        ]);
        parent::actingAs($user);

        return $this;
    }
}
