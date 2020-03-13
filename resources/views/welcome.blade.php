<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <!-- CSRF Token -->
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script
        src="{{ asset('js/app.js') }}"
        defer
    ></script>

    <!-- Styles -->
    <link
        href="{{ asset('css/app.css') }}"
        rel="stylesheet"
    >
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
</head>
<body>
<div
    id="app"
    class="flex flex-col min-h-screen bg-gray-200 antialiased font-sans"
    v-cloak
>
    <nav class="bg-gray-800 mb-4">
        <div class="container mx-auto">
            <ul class="flex">
                <li class="mr-6">
                    <router-link
                        :to="{name: 'websites.index'}"
                        class="block text-gray-100 hover:text-gray-300 py-2"
                    >
                        Websites
                    </router-link>
                </li>
                <li class="mr-6">
                    <router-link
                        :to="{name: 'websites.create'}"
                        class="block text-gray-100 hover:text-gray-300 py-2"
                    >
                        Create Website
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>

    <router-view></router-view>
</div>
</body>
</html>
