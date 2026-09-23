<header class="header">

    <div class="logo">
        <a href="/">
            Mobile Store
        </a>
    </div>

    <nav>
        <a href="/">Trang chủ</a>
        <a href="/products">Sản phẩm</a>
        <a href="/cart">Giỏ hàng</a>
        <a href="/login">Đăng nhập</a>
    </nav>

</header>

<style>
    .header {
        background-color: #111827;
        color: white;
        padding: 20px 80px;

        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo a {
        color: white;
        text-decoration: none;
        font-size: 24px;
        font-weight: bold;
    }

    nav {
        display: flex;
        gap: 25px;
    }

    nav a {
        color: white;
        text-decoration: none;
    }

    nav a:hover {
        color: #60a5fa;
    }
</style>