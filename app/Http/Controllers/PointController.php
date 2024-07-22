<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function index(): JsonResponse
    {
        $points =  Point::select('id', 'latitude', 'longitude')->get();

        return response()->json(["points" => $points]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $point = Point::create($request->only('latitude', 'longitude'));

        return response()->json($point, 201);
    }
}
