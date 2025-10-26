<?php

namespace App\Http\Controllers;

use App\Models\Clothe;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClotheController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->get('category');
        $size = $request->get('size');
        $color = $request->get('color');
        $sort = $request->get('sort', 'newest');

        $query = Clothe::where('is_active', true);

        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        if ($size && $size !== 'all') {
            $query->where('size', $size);
        }

        if ($color && $color !== 'all') {
            $query->where('color', $color);
        }

        $query->where('stock', '>', 0);

        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $clothes = $query->paginate(12);

        $categories = Clothe::where('is_active', true)->where('stock', '>', 0)->distinct()->pluck('category');
        $sizes = Clothe::where('is_active', true)->where('stock', '>', 0)->distinct()->pluck('size');
        $colors = Clothe::where('is_active', true)->where('stock', '>', 0)->distinct()->pluck('color');

        return view('clothes.index', compact(
            'clothes',
            'categories',
            'sizes',
            'colors',
            'category',
            'size',
            'color',
            'sort'
        ));
    }

    public function show(Clothe $clothe): View
    {
        if (!$clothe->is_active || $clothe->available_stock <= 0) {
            abort(404);
        }

        $relatedClothes = Clothe::where('category', $clothe->category)
            ->where('id', '!=', $clothe->id)
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('clothes.show', compact('clothe', 'relatedClothes'));
    }
}
