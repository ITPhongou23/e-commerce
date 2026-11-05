<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Review;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);

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
                'api_key' => config('services.cloudinary.api_key'),
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
        $comments = Comment::where('product_id', $productId)->join('users', 'users.id', '=', 'user_id')->select('comments.*', 'users.name')->get();
        $reviews = Review::where('product_id', $productId)->join('users', 'users.id', '=', 'user_id')->select('reviews.*', 'users.name')->get();

        return view('products.detail_product', compact('product', 'comments', 'reviews'));
    }

    public function search(Request $request)
    {
        $name = $request->name;

        $products = Product::where('name', 'LIKE', '%'.$name.'%')->paginate(10);

        return view('index', compact('products'));
    }

    public function filter(Request $request)
    {
        $name = $request->thuonghieu;

        $products = Product::where('name', 'LIKE', '%'.$name.'%')->paginate(10);

        return view('index', compact('products'));
    }

    public function desc()
    {
        $products = Product::orderBy('price', 'desc')->paginate(10);

        return view('index', compact('products'));
    }

    public function asc()
    {
        $products = Product::orderBy('price', 'asc')->paginate(10);

        return view('index', compact('products'));
    }
}
