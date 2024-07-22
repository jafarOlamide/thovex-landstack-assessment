<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PointUnitTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_a_point_in_the_db()
    {
        $response = $this->postJson(route('points.store'), [
            'latitude' => 51.700036565,
            'longitude' => -1.863078662,
        ]);

        $data = [
            'id',
            'latitude',
            'longitude',
            'created_at',
            'updated_at',
        ];

        $response->assertStatus(201)
            ->assertJsonStructure($data);

        $this->assertDatabaseHas('points', [
            'latitude' => '51.700036565',
            'longitude' => '-1.863078662',
        ]);
    }
}
