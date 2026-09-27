<div class="header" style="display: flex; justify-content: space-between; align-items: center; background-color: #6ec2f7; height: 60px;">
    <a href="/" style="margin: 0; padding: 10px;font-size: 20px; text-decoration: none; font-weight: bold;">Mobile Store</a>
    <nav>
        <a href="/" style="margin: 0; padding: 10px;font-size: 20px; text-decoration: none; margin-right: 10px;
            border: 1px solid #ccc;
            padding: 5px 10px;
            border-radius: 10px;
            background: #ffff99;">Home</a>

        <a href="/cart" style="margin: 0; padding: 10px;font-size: 20px; text-decoration: none; margin-right: 10px; border: 1px solid #ccc; padding: 5px 10px; border-radius: 10px; background: #ffff99;">
            Giỏ hàng
        </a>

        @if (Auth::check())
            <a href="/logout" style="margin: 0; padding: 10px;font-size: 20px; text-decoration: none; margin-right: 10px; border: 1px solid #ccc; padding: 5px 10px; border-radius: 10px; background: #ffff99;">
                Đăng xuất
            </a>
        @else
            <a href="/login" style="margin: 0; padding: 10px;font-size: 20px; text-decoration: none; margin-right: 10px; border: 1px solid #ccc; padding: 5px 10px; border-radius: 10px; background: #ffff99;">
                Đăng nhập
            </a>
        @endif
    </nav>
</div>