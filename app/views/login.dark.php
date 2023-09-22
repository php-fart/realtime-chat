<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="min-h-screen bg-gray-100 flex flex-col justify-center sm:py-12">
    <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">
        <h1 class="font-bold text-center text-2xl mb-5">Your Logo</h1>
        <form action="/login" method="POST" class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
            <input type="hidden" name="csrf-token" value="{{ $csrf }}"/>

            @foreach ($errors ?? [] as $error)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ $error }}</span>
            </div>
            @endforeach

            <div class="px-5 py-7">
                <label class="font-semibold text-sm text-gray-600 pb-1 block">Username</label>
                <input type="text" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" name="username"/>

                <label class="font-semibold text-sm text-gray-600 pb-1 block">Password</label>
                <input type="password" name="password" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full"/>

                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white w-full py-2.5 rounded-lg text-sm text-center inline-block">
                    <span class="inline-block mr-2">Login</span>
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
