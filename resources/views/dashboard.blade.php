<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="bg-gray-100">

        <section class="mx-10 md:mx-28 lg:mx-72 xl:mx-96 bg-white rounded">
            <div class="relative shadow-xl w-full mx-auto p-12 h-screen rounded flex items-center justify-center">

                <div class="w-full mx-16 text-center text-green-500 text-md xl:text-3xl">
                    <div class="mb-5">Welcome {{ auth()->user()->name }} </div>
                    <div>Your domain is </div>
                    <div class="font-bold animate-pulse">{{ auth()->user()->domain->domain.'.'.env('DOMAIN') }}</div>
                
                    <div class="text-sm">

                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="text-gray-100 bg-green-600 px-10 py-2 mt-5 rounded font-semibold hover:bg-green-800 " href="{{ route('register') }}">Logout</button>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    </body>
</html>
