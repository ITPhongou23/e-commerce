@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

    <style>
        .home {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Banner */
        .hero {
            background: linear-gradient(135deg, #111827, #374151);
            color: white;

            border-radius: 15px;
            padding: 70px 60px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 50px;
        }

        .hero-content {
            max-width: 600px;
        }

        .hero h1 {
            font-size: 42px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            color: #d1d5db;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .hero-button {
            display: inline-block;

            background-color: white;
            color: #111827;

            padding: 12px 25px;

            border-radius: 8px;

            text-decoration: none;
            font-weight: bold;
        }

        .hero-button:hover {
            background-color: #e5e7eb;
        }

        .hero-icon {
            font-size: 120px;
        }


        /* Section */
        .section {
            margin-bottom: 50px;
        }

        .section-title {
            text-align: center;
            font-size: 28px;
            margin-bottom: 30px;
        }


        /* Category */
        .categories {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .category {
            background-color: white;

            padding: 25px;

            border-radius: 10px;

            text-align: center;

            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);

            cursor: pointer;
        }

        .category:hover {
            transform: translateY(-5px);
            transition: 0.2s;
        }

        .category-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .category h3 {
            margin-bottom: 5px;
        }

        .category p {
            color: #666;
        }


        /* Products */
        .products {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }

        .product {
            background-color: white;

            border-radius: 10px;

            overflow: hidden;

            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .product-image {
            height: 200px;

            background-color: #e5e7eb;

            display: flex;
            justify-content: center;
            align-items: center;

            font-size: 60px;
        }

        .product-info {
            padding: 20px;
        }

        .product-info h3 {
            margin-bottom: 10px;
        }

        .product-description {
            color: #666;

            font-size: 14px;

            margin-bottom: 15px;
        }

        .product-price {
            color: #dc2626;

            font-size: 18px;

            font-weight: bold;

            margin-bottom: 15px;
        }

        .product-button {
            display: block;

            text-align: center;

            background-color: #111827;
            color: white;

            padding: 10px;

            border-radius: 6px;

            text-decoration: none;
        }

        .product-button:hover {
            background-color: #374151;
        }


        /* Responsive */
        @media (max-width: 900px) {

            .hero {
                padding: 50px 30px;
            }

            .hero-icon {
                font-size: 80px;
            }

            .categories {
                grid-template-columns: repeat(2, 1fr);
            }

            .products {
                grid-template-columns: repeat(2, 1fr);
            }
        }


        @media (max-width: 600px) {

            .hero {
                padding: 40px 25px;

                text-align: center;
            }

            .hero-icon {
                display: none;
            }

            .hero h1 {
                font-size: 30px;
            }

            .categories {
                grid-template-columns: 1fr;
            }

            .products {
                grid-template-columns: 1fr;
            }
        }

    </style>


    <div class="home">


        {{-- Banner --}}
        <section class="hero">

            <div class="hero-content">

                <h1>
                    Chào mừng đến Mobile Store
                </h1>

                <p>
                    Khám phá những chiếc điện thoại mới nhất
                    với mức giá tốt nhất.
                </p>

                <a href="/products" class="hero-button">
                    Xem sản phẩm
                </a>

            </div>

            <div class="hero-icon">
                📱
            </div>

        </section>



        {{-- Danh mục --}}
        <section class="section">

            <h2 class="section-title">
                Danh mục sản phẩm
            </h2>

            <div class="categories">

                <div class="category">

                    <div class="category-icon">
                        🍎
                    </div>

                    <h3>iPhone</h3>

                    <p>Apple</p>

                </div>


                <div class="category">

                    <div class="category-icon">
                        📱
                    </div>

                    <h3>Samsung</h3>

                    <p>Galaxy</p>

                </div>


                <div class="category">

                    <div class="category-icon">
                        🔵
                    </div>

                    <h3>Xiaomi</h3>

                    <p>Redmi</p>

                </div>


                <div class="category">

                    <div class="category-icon">
                        💻
                    </div>

                    <h3>Laptop</h3>

                    <p>MacBook & PC</p>

                </div>

            </div>

        </section>



        {{-- Sản phẩm --}}
        <section class="section">

            <h2 class="section-title">
                Sản phẩm nổi bật
            </h2>

            <div class="products">


                <div class="product">

                    <div class="product-image">
                        📱
                    </div>

                    <div class="product-info">

                        <h3>iPhone 15</h3>

                        <p class="product-description">
                            Smartphone Apple thế hệ mới.
                        </p>

                        <p class="product-price">
                            18.000.000 VNĐ
                        </p>

                        <a href="#" class="product-button">
                            Xem chi tiết
                        </a>

                    </div>

                </div>



                <div class="product">

                    <div class="product-image">
                        📱
                    </div>

                    <div class="product-info">

                        <h3>Samsung Galaxy S24</h3>

                        <p class="product-description">
                            Điện thoại Samsung cao cấp.
                        </p>

                        <p class="product-price">
                            16.000.000 VNĐ
                        </p>

                        <a href="#" class="product-button">
                            Xem chi tiết
                        </a>

                    </div>

                </div>



                <div class="product">

                    <div class="product-image">
                        📱
                    </div>

                    <div class="product-info">

                        <h3>Xiaomi 14</h3>

                        <p class="product-description">
                            Hiệu năng mạnh mẽ.
                        </p>

                        <p class="product-price">
                            12.000.000 VNĐ
                        </p>

                        <a href="#" class="product-button">
                            Xem chi tiết
                        </a>

                    </div>

                </div>



                <div class="product">

                    <div class="product-image">
                        💻
                    </div>

                    <div class="product-info">

                        <h3>MacBook Air</h3>

                        <p class="product-description">
                            Laptop mỏng nhẹ và mạnh mẽ.
                        </p>

                        <p class="product-price">
                            25.000.000 VNĐ
                        </p>

                        <a href="#" class="product-button">
                            Xem chi tiết
                        </a>

                    </div>

                </div>

            </div>

        </section>


    </div>

@endsection