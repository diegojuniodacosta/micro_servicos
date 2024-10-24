<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductsController
{
    public function index(): JsonResponse
    {
        return response()->json(Products::all());
    }

    public function store(Request $request): JsonResponse
    {
        $product = Products::query()->create($request->all());
        return response()->json($product, 201);
    }

    public function show($id): JsonResponse
    {
        return response()->json(Products::query()->findOrFail($id));
    }

    public function update(Request $request, $id): JsonResponse
    {
        $product = Products::query()->findOrFail($id);
        $product->update($request->all());
        return response()->json($product);
    }

    public function destroy($id): JsonResponse
    {
        Products::query()->findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
