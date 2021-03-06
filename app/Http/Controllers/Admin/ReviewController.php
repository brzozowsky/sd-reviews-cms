<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewPostRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ReviewController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(ReviewResource::collection(Review::all()));
    }

    public function store(ReviewPostRequest $request): JsonResponse
    {
        $review = new Review();
        $review->fill($request->all());
        $review->save();
        return response()->json(new ReviewResource($review), 201);
    }

    public function show(Review $review): JsonResponse
    {
        return response()->json(new ReviewResource($review));
    }

    public function update(Request $request, Review $review): JsonResponse
    {
        $review->update($request->all());
        return response()->json(new ReviewResource($review));
    }

    public function destroy(Request $request, Review $review): JsonResponse
    {
        try {
            $review->delete();
        } catch (Throwable $e) {
            abort(400, $e->getMessage());
        }
        return response()->json(null, 204);
    }
}
