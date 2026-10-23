<?php

namespace App\Http\Controllers;

use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Product;
use App\Http\Controllers\CartController;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('index', [
            'products' => $products,
        ]);
    }

    public function index_admin(Request $request)
    {
        $products = Product::latest()->get();
        $editing = $request->query('edit') ? Product::find($request->query('edit')) : null;

        return view('admin.index', compact('products', 'editing'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadToCloudinary($request->file('image'));
        } else {
            unset($data['image']); 
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Đã thêm sản phẩm.');
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadToCloudinary($request->file('image'));
        } else {
            unset($data['image']);
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Đã cập nhật sản phẩm.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Đã xoá sản phẩm.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'], 
        ]);
    }

    private function uploadToCloudinary(UploadedFile $file): string
    {
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key'    => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ],
            'url' => ['secure' => true],
        ]);

        $result = $cloudinary->uploadApi()->upload(
            $file->getRealPath(),
            ['folder' => 'products']
        );

        return $result['secure_url'];
    }

    public function buyToProduct($productId)
    {
        if (Auth::check()) {
            app(CartController::class)->addToCart($productId);

            return redirect()->route('buy');
        } else {
            return back()->withErrors(['error' => 'Vui lòng đăng nhập.'])->withInput();
        }
    }

    public function get_detail_product($productId)
    {
        $product = Product::where('id', $productId)->first();

        return view('products.detail_product', compact('product'));
    }
}