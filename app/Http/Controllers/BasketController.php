<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Clothe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function index()
    {
        $basketItems = Auth::user()->baskets()->with('clothe')->get();
        $total = 0;

        foreach ($basketItems as $item) {
            $total += $item->clothe->price * $item->quantity;
        }

        return view('basket.index', compact('basketItems', 'total'));
    }

    public function add(Request $request, Clothe $clothe)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Проверяем доступное количество
        $maxAvailable = $clothe->max_available_quantity;

        if ($request->quantity > $maxAvailable) {
            return redirect()->back()->withErrors([
                'quantity' => "Доступно только {$maxAvailable} шт. этого товара"
            ]);
        }

        $basketItem = Basket::where('user_id', Auth::id())
            ->where('clothe_id', $clothe->id)
            ->first();

        if ($basketItem) {
            $newQuantity = $basketItem->quantity + $request->quantity;
            if ($newQuantity > $maxAvailable) {
                return redirect()->back()->withErrors([
                    'quantity' => "Нельзя добавить больше {$maxAvailable} шт. этого товара"
                ]);
            }
            $basketItem->quantity = $newQuantity;
            $basketItem->save();
        } else {
            Basket::create([
                'user_id' => Auth::id(),
                'clothe_id' => $clothe->id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->back()->with('success', 'Товар добавлен в корзину!');
    }

    public function update(Request $request, Basket $basket)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $maxAvailable = $basket->clothe->max_available_quantity + $basket->quantity;

        if ($request->quantity > $maxAvailable) {
            return redirect()->back()->withErrors([
                'quantity' => "Максимально доступно {$maxAvailable} шт."
            ]);
        }

        $basket->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Корзина обновлена!');
    }

    public function destroy(Basket $basket)
    {
        $basket->delete();
        return redirect()->back()->with('success', 'Товар удален из корзины!');
    }
}
