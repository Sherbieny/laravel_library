<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">Books</h1>
                    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Add New Book</a>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Filter Form -->
                    <form action="{{ route('books.index') }}" method="GET" class="mb-4">
                        <div class="flex items-center">
                            <select name="category_id" id="category_id" class="block w-full text-black">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary ml-2">Filter</button>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Cover</th>
                                    <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Title</th>
                                    <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Author</th>
                                    <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Description</th>
                                    <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Publication Year
                                    </th>
                                    <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Category</th>
                                    <th class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($books as $book)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">
                                            @if ($book->cover_image)
                                                <img src="{{ asset('storage/' . $book->cover_image) }}"
                                                    alt="{{ $book->title }}" class="w-16 h-16 object-cover">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">
                                            {{ $book->title }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">
                                            {{ $book->author }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">
                                            {{ $book->description }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">
                                            {{ $book->publication_year }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">
                                            {{ $book->category->name ?? 'N/A' }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 dark:border-gray-700">
                                            <a href="{{ route('books.show', $book->id) }}"
                                                class="text-blue-500 hover:underline">View</a>
                                            <a href="{{ route('books.edit', $book->id) }}"
                                                class="text-yellow-500 hover:underline ml-2">Edit</a>
                                            <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline ml-2"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7"
                                            class="py-2 px-4 border-b border-gray-200 dark:border-gray-700 text-center">
                                            No books found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $books->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
