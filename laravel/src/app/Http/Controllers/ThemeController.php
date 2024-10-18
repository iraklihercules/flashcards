<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ThemeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/themes",
     *     description="Get Themes",
     *     tags={"Themes"},
     *     @OA\Response(response=200, description="Get resources"),
     * )
     */
    public function index(): JsonResponse
    {
        $themes = Theme::all();
        return response()->json($themes);
    }

    /**
     * @OA\Post(
     *     path="/api/themes",
     *     description="Create Theme",
     *     tags={"Themes"},
     *     @OA\Parameter(
     *         name="title",
     *         description="Title",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="category_id",
     *         description="Category ID",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(response=200, description="Resource created"),
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|max:150',
            'category_id' => 'required|exists:categories,id',
        ]);
        $category = Theme::create($request->all());
        return response()->json($category);
    }

    /**
     * @OA\Get(
     *     path="/api/themes/{theme}",
     *     description="Get Theme",
     *     tags={"Themes"},
     *     @OA\Parameter(
     *         name="theme",
     *         description="Theme Id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(response=200, description="Resource returned"),
     *     @OA\Response(response=404, description="Resource not found"),
     * )
     */
    public function show(Theme $theme): JsonResponse
    {
        return response()->json($theme);
    }

    /**
     * @OA\Put(
     *     path="/api/themes/{theme}",
     *     description="Update Theme",
     *     tags={"Themes"},
     *     @OA\Parameter(
     *         name="theme",
     *         description="Theme Id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Parameter(
     *         name="title",
     *         description="Title",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="category_id",
     *         description="Category ID",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(response=200, description="Resouce updated"),
     *     @OA\Response(response=404, description="Resource not found"),
     * )
     */
    public function update(Request $request, Theme $theme): JsonResponse
    {
        $request->validate([
            'title' => 'required|max:150',
            'category_id' => 'required|exists:categories,id',
        ]);
        $theme->update($request->all());
        return response()->json($theme);
    }

    /**
     * @OA\Delete(
     *     path="/api/themes/{theme}",
     *     description="Delete Theme",
     *     tags={"Themes"},
     *     @OA\Parameter(
     *         name="theme",
     *         description="Theme Id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(response=200, description="Resource deleted"),
     *     @OA\Response(response=404, description="Resource not found"),
     * ),
     */
    public function destroy(Theme $theme): JsonResponse
    {
        $theme->delete();
        return response()->json($theme);
    }
}
