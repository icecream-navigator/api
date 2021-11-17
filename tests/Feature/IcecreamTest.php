<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Icecream;
use App\Models\Stall;
use App\Models\User;
use JWTAuth;

class IcecreamTest extends TestCase
{


    use RefreshDatabase;

    /** @test */
    public function store_icecream_test()
    {

        $admin = User::factory()->create([
            'is_admin' => 1,
        ]);

        $stall = Stall::factory()->create([
            'id'      => 1,
            'user_id' => $admin->id,
            'owner'   => $admin->name,
        ]);

        $icecream = Icecream::factory()->definition([
            'user_id'  => $admin->id,
            'stall_id' => $stall->id,
            'stall_location' => $stall->town,
        ]);

        $response = $this->actingAsUser($admin)
                         ->post('api/icecream/store/1', $icecream);

        $response
            ->assertStatus(200);

    }

    /** @test */
    public function non_owner_cant_delete_icecream()
    {
        $owner = User::factory()->create([
            'is_admin' => 1,
            'id' => 1
        ]);

        $nonowner = User::factory()->create([
            'is_admin' => 1,
            'id' => 2
        ]);

        $stall = Stall::factory()->create([
            'user_id' => $owner->id,
            'owner' => $owner->name
        ]);


        Icecream::factory()->create([
            'id'      => 1,
            'user_id' => $owner->id,
            'stall_id' => $stall->id,

        ]);

        $response = $this->actingAsUser($nonowner)
                         ->delete('api/icecream/delete/1');

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
