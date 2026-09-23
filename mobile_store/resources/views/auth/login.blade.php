@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')

    <div class="login-container">

        <div class="login-box">

            <h1>Đăng nhập</h1>

            <form>

                <div class="form-group">
                    <label>Username</label>

                    <input
                        type="text"
                        name="username"
                        placeholder="Nhập username"
                    >
                </div>


                <div class="form-group">
                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Nhập mật khẩu"
                    >
                </div>


                <button type="submit">
                    Đăng nhập
                </button>

            </form>


            <div class="register">
                Bạn chưa có tài khoản?
                <a href="/register">Đăng ký</a>
            </div>

        </div>

    </div>


    <style>

        .login-container {
            min-height: 500px;

            display: flex;
            justify-content: center;
            align-items: center;
        }


        .login-box {
            width: 400px;

            background-color: white;

            padding: 35px;

            border-radius: 10px;

            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }


        .login-box h1 {
            text-align: center;

            margin-bottom: 30px;
        }


        .form-group {
            margin-bottom: 20px;
        }


        .form-group label {
            display: block;

            margin-bottom: 8px;

            font-weight: bold;
        }


        .form-group input {
            width: 100%;

            padding: 12px;

            border: 1px solid #ccc;

            border-radius: 6px;

            font-size: 15px;
        }


        .form-group input:focus {
            outline: none;

            border-color: #2563eb;
        }


        .login-box button {
            width: 100%;

            padding: 12px;

            border: none;

            border-radius: 6px;

            background-color: #111827;

            color: white;

            font-size: 16px;

            cursor: pointer;
        }


        .login-box button:hover {
            background-color: #374151;
        }


        .register {
            text-align: center;

            margin-top: 20px;

            color: #666;
        }


        .register a {
            color: #2563eb;

            text-decoration: none;

            font-weight: bold;
        }


        .register a:hover {
            text-decoration: underline;
        }

    </style>

@endsection