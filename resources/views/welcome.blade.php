<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>日報アプリ</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="antialiased">
    <div
        class="relative flex flex-col justify-center items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <h1 class="text-white text-2xl font-semibold mb-8">日報アプリ</h1>
        @if (Route::has('login'))
            <div class="sm:top-0 sm:right-0 p-6 text-right z-10 md:text-xl">
                @auth
                    <a href="{{ url('/report') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 bg-blue-600 px-6 py-3 rounded-md dark:text-white dark:hover:text-black focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"">日報一覧</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 bg-green-600 px-6 py-3 rounded-md dark:text-white dark:hover:text-black focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">ログイン</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 bg-blue-600 px-6 py-3 rounded-md dark:text-white dark:hover:text-black focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">新規登録</a>
                    @endif
                @endauth
            </div>
        @endif
        <div class="flex justify-center mt-8 px-0 sm:items-center sm:justify-between">
            <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </div>
</body>

</html>
