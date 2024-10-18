<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FlashcardController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/flashcards",
     *     description="Get Flashcards",
     *     tags={"Flashcards"},
     *     @OA\Response(response=200, description="Get resources"),
     * )
     */
    public function index(): JsonResponse
    {
        $themes = Flashcard::all();
        return response()->json($themes);
    }

    /**
     * @OA\Post(
     *     path="/api/flashcards",
     *     description="Create Flashcard",
     *     tags={"Flashcards"},
     *     @OA\Parameter(
     *         name="title",
     *         description="Title",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="translation",
     *         description="Translation",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         description="Description",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="category_id",
     *         description="Category ID",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Parameter(
     *         name="theme_id",
     *         description="Theme ID",
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
            'title' => 'required',
            'translation' => 'required',
            'description' => '',
            'category_id' => 'required|exists:categories,id',
            'theme_id' => 'required|exists:themes,id',
        ]);
        $flashcard = Flashcard::create($request->all());
        return response()->json($flashcard);
    }

    /**
     * @OA\Get(
     *     path="/api/flashcards/{flashcard}",
     *     description="Get Flashcard",
     *     tags={"Flashcards"},
     *     @OA\Parameter(
     *         name="flashcard",
     *         description="Flashcard Id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(response=200, description="Resource returned"),
     *     @OA\Response(response=404, description="Resource not found"),
     * )
     */
    public function show(Flashcard $flashcard): JsonResponse
    {
        return response()->json($flashcard);
    }

    /**
     * @OA\Put(
     *     path="/api/flashcards/{flashcard}",
     *     description="Update Flashcard",
     *     tags={"Flashcards"},
     *     @OA\Parameter(
     *         name="flashcard",
     *         description="Flashcard Id",
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
     *         name="translation",
     *         description="Translation",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         description="Description",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="category_id",
     *         description="Category ID",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Parameter(
     *         name="theme_id",
     *         description="Theme ID",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(response=200, description="Resouce updated"),
     *     @OA\Response(response=404, description="Resource not found"),
     * )
     */
    public function update(Request $request, Flashcard $flashcard): JsonResponse
    {
        $request->validate([
            'title' => 'required',
            'translation' => 'required',
            'description' => '',
            'category_id' => 'required|exists:categories,id',
            'theme_id' => 'required|exists:themes,id',
        ]);
        $flashcard->description = $request->get('description');
        $flashcard->update($request->all());
        return response()->json($flashcard);
    }

    /**
     * @OA\Delete(
     *     path="/api/flashcards/{flashcard}",
     *     description="Delete Flashcard",
     *     tags={"Flashcards"},
     *     @OA\Parameter(
     *         name="flashcard",
     *         description="Flashcard Id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *     ),
     *     @OA\Response(response=200, description="Resource deleted"),
     *     @OA\Response(response=404, description="Resource not found"),
     * ),
     */
    public function destroy(Flashcard $flashcard): JsonResponse
    {
        $flashcard->delete();
        return response()->json($flashcard);
    }
}
