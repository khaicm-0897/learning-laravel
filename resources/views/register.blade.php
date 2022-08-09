<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Register form</title>

    <!-- Styles -->
    @vite('resources/css/app.css')

</head>

<body class="bg-white h-screen antialiased leading-none font-sans">
    <div id="app">
        <div class="header sticky top-0 z-50">
            <main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-5">
                <div class="flex">
                    <div class="w-full">
                        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-lg">

                            <header
                                class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                                Register
                            </header>

                            <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST"
                                enctype="multipart/form-data" action="{{ route('register') }}">
                                @csrf

                                <div class="flex flex-wrap">
                                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                        Name: <span class=" text-red-500">*</span>
                                    </label>

                                    <input id="name" type="text"
                                        class="   border-gray-600 border w-full @error('name') border-indigo-900 @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name"
                                        autofocus>

                                    @error('name')
                                        <p class="text-red-500 text-xs italic mt-4">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="flex flex-wrap">
                                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                        Email: <span class=" text-red-500">*</span>
                                    </label>

                                    <input id="email" type="email"
                                        class="   border-gray-600 border w-full @error('email') border-indigo-900 @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <p class="text-red-500 text-xs italic mt-4">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="flex flex-wrap">
                                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                        Password: <span class=" text-red-500">*</span>
                                    </label>

                                    <input id="password" type="password"
                                        class="   border-gray-600 border w-full @error('password') border-indigo-900 @enderror"
                                        name="password" required autocomplete="new-password">

                                    @error('password')
                                        <p class="text-red-500 text-xs italic mt-4">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="flex flex-wrap">
                                    <label for="password-confirm"
                                        class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                        Confirm password: <span class=" text-red-500">*</span>
                                    </label>

                                    <input id="password-confirm" type="password" class="border-gray-600 border w-full"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="flex flex-wrap">
                                    <label for="password-confirm"
                                        class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                        Avatar: <span class=" text-red-500">*</span>
                                    </label>

                                    <input id="password-confirm" type="file" class="border-gray-600 w-full" required
                                        name="avatar" accept="image/png, image/jpeg, image/jpg">
                                    @error('avatar')
                                        <p class="text-red-500 text-xs italic mt-4">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="flex flex-wrap">
                                    <button type="submit"
                                        class=" mb-5 w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-indigo-900  hover:bg-indigo-800 sm:py-4">
                                        Register
                                    </button>
                                </div>
                            </form>

                        </section>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
