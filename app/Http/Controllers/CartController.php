<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\WebResponse;
use App\Repositories\CartRepositoryInterface;

class CartController extends Controller
{
    use WebResponse;

    public function __construct(private CartRepositoryInterface $cartRepo) {}

    public function index()
    {
        $carts = $this->cartRepo->all();
        return view('carts.index', compact('carts'));
    }

    public function create()
    {
        $products = Product::select('id', 'name')->get();
        $users = User::select('id', 'name')->get();
        return view('carts.create', compact('products', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cookie_id' => 'required|uuid',
            'user_id' => 'nullable|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);

        $data['amount'] = $data['price'] * $data['quantity'];
        $this->cartRepo->create($data);

        return $this->redirectWithMessage('carts.index', 'Cart item added.');
    }

    public function show(Cart $cart)
    {
        return view('carts.show', compact('cart'));
    }

    public function edit(Cart $cart)
    {
        $products = Product::select('id', 'name')->get();
        $users = User::select('id', 'name')->get();
        return view('carts.edit', compact('cart', 'products', 'users'));
    }

    public function update(Request $request, Cart $cart)
    {
        $data = $request->validate([
            'cookie_id' => 'required|uuid',
            'user_id' => 'nullable|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);

        $data['amount'] = $data['price'] * $data['quantity'];
        $this->cartRepo->update($cart, $data);

        return $this->redirectWithMessage('carts.index', 'Cart item updated.');
    }

    public function destroy(Cart $cart)
    {
        $this->cartRepo->delete($cart);
        return $this->redirectWithMessage('carts.index', 'Cart item removed.');
    }
}
