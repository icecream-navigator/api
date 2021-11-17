<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Stall;
use App\Models\User;
use JWTAuth;

class StallTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;


    /** @test */
    public function store_stall_test()
    {

        $user = User::factory()->create();

        $stall =  Stall::factory()->create([
            'user_id' => $user->id,
            'owner'   => $user->name,
        ]);

        $this->assertCount(1, Stall::all());


    }

    /** @test */
    public function delete_stall_test()
    {
        $user = User::factory()->create();

        $stall = Stall::factory()->create([
            'user_id' => $user->id,
            'owner'   => $user->name
        ]);

        $stall->delete();

        $this->assertCount(0, Stall::all());

    }

    /** @test */
    public function non_owner_cant_delete()
    {
        $owner = User::factory()->create([
            'is_admin' => 1,
        ]);

        $nonowner = User::factory()->create([
            'is_admin' => 1,
            'id' => 2
        ]);

        $stall = Stall::factory()->create([
            'id'      => 1,
            'user_id' => $owner->id,
            'owner'   => $owner->name,
        ]);

        $response = $this->actingAsUser($nonowner)->delete('api/stall/delete/1');

        $response
            ->assertStatus(401);
    }

    /** @test */
    public function stall_update_test()
    {
        $owner = User::factory()->create([
            'is_admin' => 1,
        ]);

        $stall = Stall::factory()->create([
            'user_id' => $owner->id,
            'owner'   => $owner->name,
            'id'      => 1
        ]);
        $stall_orginal = $stall->name;

        $stall->name = 'name update';
        $stall->town = 'Warsaw';


        $new_name = $stall->name;

        $result   = $stall_orginal === $new_name;

        $this->assertFalse($result);
    }

    /** @test */
    public function  non_owner_cant_update()
    {
        $owner = User::factory()->create([
            'is_admin' => 1,
        ]);

        $nonowner = User::factory()->create([
            'is_admin' => 1,
            'id' => 2
        ]);


        $stall = Stall::factory()->create([
            'user_id' => $owner->id,
            'owner' => $owner->name,
            'id' => 1
        ]);

        $stall->save();

        $response = $this->actingAsUser($nonowner)->post('api/stall/update/1');

        $response
            ->assertStatus(401);
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
