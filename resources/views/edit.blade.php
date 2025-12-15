<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>

    <style type="text/tailwindcss">
        @layer utilities {
            .container {
                @apply px-10 mx-auto;
            }
        }
    </style>

    <title>Hello</title>
</head>

<body>

    <div class="container">
        <div class="flex justify-between my-5">
            <h2 class='text-red-500 text-xl'>Edit - {{ $ourPost->name }}</h2>
            <a href="/" class = "bg-green-600 text-white rounded py-2 px-4">Back To Home</a>

        </div>
    </div>

    <div class="mx-10">
        <form method="POST" action="{{ route('update', $ourPost->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col gap-5">
                <label for="">Name</label>
                @error('name')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
                {{-- <input type="text" name="name" value=""{{ old('name', $ourPost->name) }}""
                    class="border px-4 py-2 rounded"> --}}
                <input type="text" name="name" value="{{ old('name', $ourPost->name) }}"
                    class="border px-4 py-2 rounded">

                <!-- here is this old('name') means if the form is submitted with errors, it will repopulate the name field with the previous value -->
                <label for="">Description</label>
                @error('description')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
                {{-- <input type="text" name="description" value="{{ $ourPost->description }}"
                    class="border px-4 py-2 rounded"> --}}
                <input type="text" name="description" value="{{ old('description', $ourPost->description) }}"
                    class="border px-4 py-2 rounded">

                <label for="">Image</label>
                @error('image')
                    <span class="text-red-600">{{ $message }}</span>
                @enderror
                <input type="file" name="image" value="{{ old('image') }}" class="border px-4 py-2 rounded">
                <input type="submit" class="bg-green-500 text-white py-2 px-4 rounded inline-block">


            </div>
        </form>
    </div>


</body>

</html>
