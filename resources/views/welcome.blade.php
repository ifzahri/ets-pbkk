<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Mediheal</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="dark:bg-black dark:text-white/50 flex items-center justify-center min-h-screen">
        <section class="bg-white dark:bg-gray-900">
            <div class="mx-auto max-w-screen-xl px-4 py-8 text-center lg:px-12 lg:py-16">
                <h1
                    class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 dark:text-white md:text-5xl lg:text-6xl"
                >
                    Welcome to Mediheal!
                </h1>
                <p class="mb-8 text-lg font-normal text-gray-500 dark:text-gray-400 sm:px-16 lg:text-xl xl:px-48">
                    We focus on providing healthcare solutions that leverage technology, innovation, and expertise to enhance patient care and drive better health outcomes.
                </p>
                <div
                    class="mb-8 flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-x-4 sm:space-y-0 lg:mb-16"
                >
                    <a
                        href="{{ route('login') }}"
                        class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-5 py-3 text-center text-base font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900"
                    >
                        Login
                    </a>
                    <a
                        href="{{ route('register') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-5 py-3 text-center text-base font-medium text-gray-900 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                    >
                        Register
                    </a>
                </div>
                <div class="mx-auto px-4 text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-36">
                    <div class="mt-8 flex flex-wrap items-center justify-center text-gray-500 sm:justify-between">
                        <a href="#" class="mb-5 mr-5 hover:text-gray-800 dark:hover:text-gray-400 lg:mb-0"></a>
                        <a href="#" class="mb-5 mr-5 hover:text-gray-800 dark:hover:text-gray-400 lg:mb-0"></a>
                        <a href="#" class="mb-5 mr-5 hover:text-gray-800 dark:hover:text-gray-400 lg:mb-0"></a>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
