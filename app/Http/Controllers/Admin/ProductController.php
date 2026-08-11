<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('category_name')->get();
        $statuses = $this->statuses();

        return view('admin.products.create', compact('categories', 'statuses'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            $validated['image_url'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($validated);

        if ($request->hasFile('images')) {
            $isFirst = true;
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                
                // If it's the first image, also save it to the product's image_url
                if ($isFirst) {
                    $product->update(['image_url' => $path]);
                }
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $path,
                    'alt_text' => $product->product_name,
                    'is_primary' => $isFirst,
                    'uploaded_at' => now(),
                ]);
                $isFirst = false;
            }
        } elseif ($request->hasFile('image')) {
            // Fallback for single image input if it still exists
            $path = $request->file('image')->store('products', 'public');
            $product->update(['image_url' => $path]);
            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => $path,
                'alt_text' => $product->product_name,
                'is_primary' => true,
                'uploaded_at' => now(),
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('category_name')->get();
        $statuses = $this->statuses();

        return view('admin.products.edit', compact('product', 'categories', 'statuses'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
                Storage::disk('public')->delete($product->image_url);
            }

            $validated['image_url'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        if ($request->hasFile('images')) {
            // Delete old images if new ones are uploaded
            foreach ($product->images as $img) {
                if (Storage::disk('public')->exists($img->image_url)) {
                    Storage::disk('public')->delete($img->image_url);
                }
                $img->delete();
            }

            $isFirst = true;
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                
                if ($isFirst) {
                    $product->update(['image_url' => $path]);
                }

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $path,
                    'alt_text' => $product->product_name,
                    'is_primary' => $isFirst,
                    'uploaded_at' => now(),
                ]);
                $isFirst = false;
            }
        } elseif ($request->hasFile('image')) {
            // Fallback for single image upload
            if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
                Storage::disk('public')->delete($product->image_url);
            }
            $path = $request->file('image')->store('products', 'public');
            $product->update(['image_url' => $path]);
            
            ProductImage::updateOrCreate(
                ['product_id' => $product->id, 'is_primary' => true],
                [
                    'image_url' => $path,
                    'alt_text' => $product->product_name,
                    'uploaded_at' => now(),
                ]
            );
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    private function validateProduct(Request $request)
    {
        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'product_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'warranty_period' => ['nullable', 'string', 'max:255'],
            'release_date' => ['nullable', 'date'],
            'status' => ['required', 'in:Available,Out_Of_Stock,Discontinued,Coming_Soon,Hidden'],
            'image' => ['nullable', 'image', 'max:2048'],
            'images.*' => ['nullable', 'image', 'max:2048'],
            'images' => ['nullable', 'array', 'max:4'],
        ]);
    }

    private function statuses()
    {
        return ['Available', 'Out_Of_Stock', 'Discontinued', 'Coming_Soon', 'Hidden'];
    }
}
