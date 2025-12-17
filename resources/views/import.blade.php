<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Import</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
        {{-- <form method="POST" action="" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col gap-2">
                <label for="csv" class="font-semibold text-gray-700">
                    Upload CSV File
                </label>

                @error('csv')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror

                <input type="file" name="csv" id="csv" accept=".csv" class="border px-4 py-2 rounded">
            </div>

            <a href="{{ route('import.store') }}"
                class="inline-flex w-28 justify-center px-6 py-3 bg-gradient-to-r from-green-400 to-green-600 text-white font-semibold rounded-lg shadow-md hover:from-green-500 hover:to-green-700 hover:shadow-lg transition-all duration-300">
                Save
            </a>

        </form> --}}

        <form method="POST" action="{{ route('import.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col gap-2">
                <label for="csv" class="font-semibold text-gray-700">
                    Upload CSV File
                </label>

                @error('csv')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror

                <input type="file" name="csv" id="csv" accept=".csv" class="border px-4 py-2 rounded">
            </div>

            <button type="submit"
                class="mt-4 inline-flex w-28 justify-center px-6 py-3 bg-gradient-to-r from-green-400 to-green-600 text-white font-semibold rounded-lg shadow-md hover:from-green-500 hover:to-green-700 transition-all">
                Save
            </button>
        </form>

    </div>

</body>

</html>
