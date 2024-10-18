<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class TokenController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/csrf_token",
     *     description="Get CSRF token",
     *     tags={"Tokens"},
     *     @OA\Response(response=200, description="Resource returned"),
     * )
     */
    public function index(): JsonResponse
    {
        $token = csrf_token();
        return response()->json(['_token' => $token]);
    }
}
