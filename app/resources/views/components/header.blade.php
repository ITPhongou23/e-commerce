<div class="header" style="display: flex; justify-content: space-between; align-items: center; background-color: #6ec2f7; height: 60px;">
    <a href="/" style="margin: 0; padding: 10px;font-size: 20px; text-decoration: none; font-weight: bold;">Mobile Store</a>
    <div class=" flex">
        <a href="/" style="margin: 0; padding: 10px;font-size: 20px; text-decoration: none; margin-right: 10px;border: 1px solid #ccc;padding: 5px 10px;border-radius: 10px;background: #ffff99;">
            Home
        </a>

        <a href="/cart" style="margin: 0; padding: 10px;font-size: 20px; text-decoration: none; margin-right: 10px; border: 1px solid #ccc; padding: 5px 10px; border-radius: 10px; background: #ffff99;">
            Giỏ hàng
        </a>

        @if(auth()->user()?->isAdmin())
            <a href="{{ route('admin.products.index') }}" style="margin: 0; padding: 10px;font-size: 20px; text-decoration: none; margin-right: 10px; border: 1px solid #ccc; padding: 5px 10px; border-radius: 10px; background: #ffff99;">
                Quản lý sản phẩm
            </a>

            <a href="{{ route('admin.orders.index') }}" style="margin: 0; padding: 10px;font-size: 20px; text-decoration: none; margin-right: 10px; border: 1px solid #ccc; padding: 5px 10px; border-radius: 10px; background: #ffff99;">
                Quản lý đơn hàng
            </a>
        @endif

        @auth
            <form action="/logout" methods="POST">
                @method('DELETE')
                <button class="btn btn-ghost" style="margin: 0; padding: 10px;font-size: 20px; text-decoration: none; margin-right: 10px; border: 1px solid #ccc; padding: 5px 10px; border-radius: 10px; background: #ffff99;">
                    Đăng xuất
                </button>
            </form>
        @endauth

        @guest
            <a href="/login" class="btn btn-primary" style="margin: 0; padding: 10px;font-size: 20px; text-decoration: none; margin-right: 10px; border: 1px solid #ccc; padding: 5px 10px; border-radius: 10px; background: #ffff99;">
                Đăng nhập
            </a>
        @endguest
    </div>
</div>