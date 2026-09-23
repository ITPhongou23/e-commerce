<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Mobile Store')</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            padding: 40px 80px;
        }
    </style>
</head>

<body>

    {{-- Header --}}
    @include('component.header')


    {{-- Body --}}
    <main>
        @yield('content')
    </main>


    {{-- Footer --}}
    @include('component.footer')

</body>

</html>