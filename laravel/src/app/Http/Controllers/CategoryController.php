<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/categories",
     *     description="Get Categories",
     *     tags={"Categories"},
     *     @OA\Response(response=200, description="Get resources"),
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $page = (int) $request->query('page');
        $page = $page > 0 ? $page : 1;
        $itemsPerPage = 10;

        $query = Category::query();

        // Count
        $totalItems = $query->count();
        $totalPages = ceil($totalItems / $itemsPerPage);

        // Items
        $skip = ($page - 1) * $itemsPerPage;
        $items = $query
            ->offset($skip)
            ->limit($itemsPerPage)
            ->get();

        return response()->json([
            'page' => $page,
            'totalPages' => $totalPages,
            'totalItems' => $totalItems,
            'items' => $items,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/categories",
     *     description="Create Category",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="title",
     *         description="Title",
     *         required=true,
     *         in="query",
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Response(response=200, description="Resource created"),
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|max:150',
        ]);
        $category = Category::create($request->all());
        return response()->json($category);
    }

    /**
     * @OA\Get(
     *     path="/api/categories/{category}",
     *     description="Get Category",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="category",
     *         description="Category Id",
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(response=200, description="Resource returned"),
     *     @OA\Response(response=404, description="Resource not found"),
     * )
     */
    public function show(Category $category): JsonResponse
    {
        return response()->json($category);
    }

    /**
     * @OA\Put(
     *     path="/api/categories/{category}",
     *     description="Update Category",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="category",
     *         description="Category Id",
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Parameter(
     *         name="title",
     *         description="Title",
     *         required=true,
     *         in="query",
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Response(response=200, description="Resouce updated"),
     *     @OA\Response(response=404, description="Resource not found"),
     * )
     */
    public function update(Request $request, Category $category): JsonResponse
    {
        $request->validate([
            'title' => 'required|max:150',
        ]);
        $category->update($request->all());
        return response()->json($category);
    }

    /**
     * @OA\Delete(
     *     path="/api/categories/{category}",
     *     description="Delete Category",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="category",
     *         description="Category Id",
     *         required=true,
     *         in="path",
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(response=200, description="Resource deleted"),
     *     @OA\Response(response=404, description="Resource not found"),
     * ),
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return response()->json($category);
    }
}
