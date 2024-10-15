<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class TokenController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/token",
     *     description="Get CSRF token",
     *     tags={"Token"},
     *     @OA\Response(response=200, description="Get token"),
     * )
     */
    public function index(): JsonResponse
    {
        $token = csrf_token();
        return response()->json(['_token' => $token]);
    }
}
