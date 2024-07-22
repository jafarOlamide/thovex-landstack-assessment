<?php

namespace Tests\Feature;

use App\Models\Point;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PointTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_index_page()
    {
        $response = $this->get(route('index'));

        $response->assertStatus(200);
    }

    public function test_it_returns_stored_points_from_db()
    {
        Point::factory()->count(10)->create();

        $response = $this->get(route('points.index'));

        $data = [
            'points' => [
                '0' => [
                    'id',
                    'latitude',
                    'longitude',
                ],
            ],
        ];

        $response->assertJsonStructure($data);
    }
}
