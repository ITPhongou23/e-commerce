@extends('layouts.app')

@section('title', 'Đăng ký')

@section('content')

    <div class="register-container">

        <div class="register-box">

            <h1>Đăng ký tài khoản</h1>

            <form>

                <div class="form-group">
                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Nhập email"
                    >
                </div>


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


                <div class="form-group">
                    <label>Confirm Password</label>

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Xác nhận mật khẩu"
                    >
                </div>


                <button type="submit">
                    Đăng ký
                </button>

            </form>


            <div class="login-link">
                Đã có tài khoản?

                <a href="/login">
                    Đăng nhập
                </a>
            </div>

        </div>

    </div>


    <style>

        .register-container {
            min-height: 500px;

            display: flex;
            justify-content: center;
            align-items: center;
        }


        .register-box {
            width: 420px;

            background-color: white;

            padding: 35px;

            border-radius: 10px;

            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }


        .register-box h1 {
            text-align: center;

            margin-bottom: 30px;
        }


        .form-group {
            margin-bottom: 18px;
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


        .register-box button {
            width: 100%;

            padding: 12px;

            margin-top: 5px;

            border: none;

            border-radius: 6px;

            background-color: #111827;

            color: white;

            font-size: 16px;

            cursor: pointer;
        }


        .register-box button:hover {
            background-color: #374151;
        }


        .login-link {
            text-align: center;

            margin-top: 20px;

            color: #666;
        }


        .login-link a {
            color: #2563eb;

            text-decoration: none;

            font-weight: bold;
        }


        .login-link a:hover {
            text-decoration: underline;
        }

    </style>

@endsection