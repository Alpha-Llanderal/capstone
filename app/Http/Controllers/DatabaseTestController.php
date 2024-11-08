<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class DatabaseTestController extends Controller
{
    public function testConnection(): JsonResponse
    {
        try {
            DB::connection()->getPdo();
            return response()->json(['message' => 'Database connection is successful!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Could not connect to the database. Error: ' . $e->getMessage()], 500);
        }
    }
}