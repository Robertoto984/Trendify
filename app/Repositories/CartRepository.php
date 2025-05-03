<?php

namespace App\Repositories;

use App\Models\Cart;
use Illuminate\Support\Collection;

class CartRepository implements CartRepositoryInterface
{
    public function all(): Collection
    {
        return Cart::with(['product', 'user'])->get();
    }

    public function find(string $id): ?Cart
    {
        return Cart::find($id);
    }

    public function create(array $data): Cart
    {
        return Cart::create($data);
    }

    public function update(Cart $cart, array $data): Cart
    {
        $cart->update($data);
        return $cart;
    }

    public function delete(Cart $cart): void
    {
        $cart->delete();
    }
}
