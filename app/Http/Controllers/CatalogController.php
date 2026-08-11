<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    // Home page: only products that the customer can actually buy are shown.
    public function home()
    {
        $featuredProducts = Product::query()
            ->with(['category', 'primaryImage'])
            ->where('status', 'Available')
            ->where('stock_quantity', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::query()
            ->withCount(['products as available_products_count' => function ($query) {
                $query->where('status', 'Available')->where('stock_quantity', '>', 0);
            }])
            ->orderBy('category_name')
            ->get();

        return view('catalog.home', compact('featuredProducts', 'categories'));
    }

    // Catalog page: every filter remains in the URL so pagination does not reset it.
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'category' => ['nullable', 'integer', 'exists:categories,id'],
            'min_price' => ['nullable', 'numeric', 'min:0'],
            'max_price' => ['nullable', 'numeric', 'min:0', 'gte:min_price'],
            'sort' => ['nullable', 'in:latest,price_low,price_high,name'],
        ]);

        $products = Product::query()
            ->with(['category', 'primaryImage'])
            ->where('status', 'Available')
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('product_name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($filters['category'] ?? null, fn ($query, $category) => $query->where('category_id', $category))
            ->when($filters['min_price'] ?? null, fn ($query, $price) => $query->where('price', '>=', $price))
            ->when($filters['max_price'] ?? null, fn ($query, $price) => $query->where('price', '<=', $price))
            ->when(($filters['sort'] ?? 'latest') === 'price_low', fn ($query) => $query->orderBy('price'))
            ->when(($filters['sort'] ?? 'latest') === 'price_high', fn ($query) => $query->orderByDesc('price'))
            ->when(($filters['sort'] ?? 'latest') === 'name', fn ($query) => $query->orderBy('product_name'))
            ->when(($filters['sort'] ?? 'latest') === 'latest', fn ($query) => $query->latest())
            ->paginate(9)
            ->withQueryString();

        $categories = Category::orderBy('category_name')->get();

        return view('catalog.index', compact('products', 'categories', 'filters'));
    }

    // Route model binding keeps the query and the not-found handling simple.
    public function show(Product $product)
    {
        abort_if($product->status === 'Hidden', 404);

        $product->load(['category', 'images' => fn ($query) => $query->orderByDesc('is_primary')->latest()]);

        return view('catalog.show', compact('product'));
    }
}
