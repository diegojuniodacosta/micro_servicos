<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController
{
    public function addProduct(Request $request, $cartId): JsonResponse
    {
        // Faz uma requisição HTTP para o serviço de produtos
        $response = Http::get('http://product-service/api/products/' . $request->product_id);
        $product = $response->json();

        if (!$product) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }

        // Se o produto for válido, adiciona ao carrinho
        $cart = Cart::findOrFail($cartId);
        $cartItem = CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json($cartItem, 201);
    }

    public function removeProduct($cartId, $productId): JsonResponse
    {
        $cartItem = CartItem::where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->firstOrFail();
        $cartItem->delete();
        return response()->json(null, 204);
    }

    public function show($cartId): JsonResponse
    {
        $cart = Cart::with('cartItems')->findOrFail($cartId);
        return response()->json($cart);
    }
}
