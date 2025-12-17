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

            /* .btn {
                bg-green-600 text-white
            } */
        }
    </style>

    <title>Hello</title>
</head>

<body>

    <div class="container">
        <div class="flex justify-between my-5">
            <h2 class='text-red-500 text-xl'>Home</h2>

            <a href="{{ asset('demo/post.csv') }}" download class = "bg-yellow-600 text-white rounded py-2 px-4">Demo
                CSV</a>
            <a href="/import" class = "bg-yellow-600 text-white rounded py-2 px-4">Import by CSV</a>

            <a href="/create" class = "bg-green-600 text-white rounded py-2 px-4">Add New Post</a>
        </div>



        @if (session('success'))
            <h2 class="text-green-600 py-5 mx-auto">
                {{ session('success') }}
            </h2>
        @endif


        <form action="{{ route('search') }}" method="GET" class="my-5 flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search by name or description..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">

            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                Search
            </button>
        </form>


        <div>
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 border border-green-300 my-5">
                                <thead class="bg-green-600">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-white uppercase">
                                            Id</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-white uppercase">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-start text-xs font-medium text-white uppercase">
                                            Description</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-white uppercase">
                                            Image</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-end text-xs font-medium text-white uppercase">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($posts as $item)
                                        <tr class="odd:bg-white even:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                                {{ $item->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                {{ $item->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                                {{ $item->description }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-middle text-sm text-gray-800">
                                                <img src="image/{{ $item->image }}" width="80px" height="80px"
                                                    alt="">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                {{-- <button type="button"
                                                    class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-hidden focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Edit</button> --}}

                                                {{-- <a href="{{ route('edit', $item->id) }}"
                                                    class="inline-block px-6 py-3 bg-gradient-to-r from-green-400 to-green-600 text-white font-semibold rounded-lg shadow-md hover:from-green-500 hover:to-green-700 hover:shadow-lg transition-all duration-300">
                                                    Edit
                                                </a>

                                                <a href="{{ route('edit', $item->id) }}"
                                                    class="inline-block px-6 py-3 bg-gradient-to-r from-red-400 to-red-600 text-white font-semibold rounded-lg shadow-md hover:from-green-500 hover:to-green-700 hover:shadow-lg transition-all duration-300">
                                                    Delete
                                                </a> --}}

                                                <a href="{{ route('edit', $item->id) }}"
                                                    class="inline-flex w-28 justify-center px-6 py-3 bg-gradient-to-r from-green-400 to-green-600 text-white font-semibold rounded-lg shadow-md hover:from-green-500 hover:to-green-700 hover:shadow-lg transition-all duration-300">
                                                    Edit
                                                </a>

                                                <a href="{{ route('delete', $item->id) }}"
                                                    class="inline-flex w-28 justify-center px-6 py-3 bg-gradient-to-r from-red-400 to-red-600 text-white font-semibold rounded-lg shadow-md hover:from-red-500 hover:to-red-700 hover:shadow-lg transition-all duration-300">
                                                    Delete
                                                </a>


                                        </tr>
                                    @endforeach



                                </tbody>
                            </table>
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</body>

</html>
