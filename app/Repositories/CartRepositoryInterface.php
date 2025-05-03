<?php

namespace App\Repositories;

use App\Models\Cart;
use Illuminate\Support\Collection;

interface CartRepositoryInterface
{
    public function all(): Collection;
    public function find(string $id): ?Cart;
    public function create(array $data): Cart;
    public function update(Cart $cart, array $data): Cart;
    public function delete(Cart $cart): void;
}
