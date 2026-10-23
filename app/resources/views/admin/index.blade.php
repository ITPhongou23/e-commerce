<x-layout>
    <div style="padding: 20px;">
        <h1>Quản lý sản phẩm</h1>
 
        @if(session('success'))
            <div style="padding: 10px; background: #d4edda; border-radius: 8px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif
 
        @if($errors->any())
            <div style="padding: 10px; background: #f8d7da; border-radius: 8px; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
 
        {{-- FORM THÊM / SỬA --}}
        <form action="{{ $editing ? route('admin.products.update', $editing) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data" style="border: 1px solid #ccc; border-radius: 10px; padding: 15px; margin-bottom: 25px; background: #f9f9f9;">
            @csrf
            @if($editing)
                @method('PUT')
            @endif
 
            <h2 style="margin-top: 0;">{{ $editing ? 'Sửa sản phẩm #' . $editing->id : 'Thêm sản phẩm' }}</h2>
 
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">
                <div>
                    <label>Tên sản phẩm</label><br>
                    <input type="text" name="name" value="{{ old('name', $editing->name ?? '') }}" style="width: 100%; padding: 8px;">
                </div>
 
                <div>
                    <label>Ảnh sản phẩm (để trống dùng ảnh mặc định / giữ ảnh cũ)</label><br>
                    <input type="file" name="image" accept="image/*" style="width: 100%; padding: 8px;">

                    @if(!empty($editing->image))
                        <p style="margin: 8px 0 4px;">Ảnh hiện tại:</p>
                        <img src="{{ $editing->image }}" alt="" style="max-width: 150px; border-radius: 6px;">
                    @endif

                    @error('image')
                        <p style="color: red; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>
 
                <div>
                    <label>Giá</label><br>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $editing->price ?? '') }}" style="width: 100%; padding: 8px;">
                </div>
 
                <div>
                    <label>Tồn kho</label><br>
                    <input type="number" name="stock" value="{{ old('stock', $editing->stock ?? 0) }}" style="width: 100%; padding: 8px;">
                </div>
            </div>
 
            <div style="margin-top: 12px;">
                <label>Mô tả</label><br>
                <textarea name="description" rows="3" style="width: 100%; padding: 8px;">{{ old('description', $editing->description ?? '') }}</textarea>
            </div>
 
            <div style="margin-top: 12px;">
                <button type="submit" style="padding: 8px 16px; background: {{ $editing ? '#ffc107' : '#28a745' }}; color: {{ $editing ? '#000' : '#fff' }}; border: none; border-radius: 8px; cursor: pointer;">
                    {{ $editing ? 'Cập nhật' : 'Thêm' }}
                </button>
 
                @if($editing)
                    <a href="{{ route('admin.products.index') }}" style="margin-left: 10px;">Huỷ sửa</a>
                @endif
            </div>
        </form>
 
        {{-- DANH SÁCH --}}
        <table border="1" cellpadding="8" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Tồn kho</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr @if($editing && $editing->id === $product->id) style="background: #fff8dc;" @endif>
                        <td>{{ $product->id }}</td>
                        <td><img src="{{ $product->image }}" width="60" alt="{{ $product->name }}" referrerpolicy="no-referrer"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price, 0, ',', '.') }}đ</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a href="{{ route('admin.products.index', ['edit' => $product->id]) }}"
                               style="padding: 5px 10px; background: #ffc107; border-radius: 6px; text-decoration: none; color: #000;">Sửa</a>
 
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline;"
                                  onsubmit="return confirm('Bạn chắc chắn muốn xoá sản phẩm này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="padding: 5px 10px; background: #dc3545; color: #fff; border: none; border-radius: 6px; cursor: pointer;">Xoá</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Chưa có sản phẩm nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>
 