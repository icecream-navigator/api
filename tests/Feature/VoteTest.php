<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Stall;
use App\Models\Icecream;
use App\Models\Vote;
use JWTAuth;



class VoteTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function admins_cant_vote()
    {
        $admin = User::factory()->create([
            'is_admin' => 1,
        ]);

        $stall = Stall::factory()->create([
            'id'      => 1,
            'user_id' => $admin->id,
            'owner'   => $admin->name,
        ]);


        $icecream = Icecream::factory()->create([
            'user_id'  => $admin->id,
            'stall_id' => $stall->id,
            'stall_location' => $stall->town,
        ]);

        $vote = Vote::factory()->definition([
            'user_id' => $admin->id,
            'icecream_id' => $icecream->id,
        ]);

        $response = $this->actingAsUser($admin)
                         ->post('api/icecream/vote/1', $vote);

        $response
            ->assertStatus(403);
    }

    /** @test */
    public function user_cannot_vote_more_than_once_for_same_icecream()
    {
        $admin = User::factory()->create([
            'is_admin' => 1
        ]);

        $user = User::factory()->create([
            'is_admin' => 0
        ]);

        $stall = Stall::factory()->create([
            'id'      => 1,
            'user_id' => $admin->id,
            'owner'   => $admin->name,
        ]);


        $icecream = Icecream::factory()->create([
            'id' => 1,
            'user_id'  => $admin->id,
            'stall_id' => $stall->id,
            'stall_location' => $stall->town,
        ]);

        $vote = Vote::factory()->definition([
            'user_id' => $user->id,
            'icecream_id' => $icecream->id,
        ]);

        $this->actingAsUser($user)
             ->post('api/icecream/vote/ '.$icecream->id, $vote);

        $response = $this->actingAsUser($user)
                         ->post('api/icecream/vote/ '.$icecream->id, $vote);


        $response
            ->assertStatus(403);
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
