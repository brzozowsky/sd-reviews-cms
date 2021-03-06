<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuLinkPostRequest;
use App\Http\Resources\MenuLinkResource;
use App\Models\MenuLink;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Throwable;

class MenuLinkController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(MenuLinkResource::collection(MenuLink::all()));
    }

    public function store(MenuLinkPostRequest $request): JsonResponse
    {
        $menuLink = new MenuLink();
        $menuLink->fill($request->all());
        $menuLink->save();
        return response()->json(new MenuLinkResource($menuLink), 201);
    }

    public function show(MenuLink $menuLink): JsonResponse
    {
        return response()->json(new MenuLinkResource($menuLink));
    }


    public function update(Request $request, MenuLink $menuLink): JsonResponse
    {
        $menuLink->update($request->all());
        return response()->json(new MenuLinkResource($menuLink));
    }

    public function destroy(Request $request, MenuLink $menuLink): JsonResponse
    {
        try {
            $menuLink->delete();
        } catch (Throwable $e) {
            abort(400, $e->getMessage());
        }
        return response()->json(null, 204);
    }
}
