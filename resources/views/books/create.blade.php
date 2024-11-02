<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">Add New Book</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="title"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full text-black"
                                value="{{ old('title') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="author"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Author</label>
                            <input type="text" name="author" id="author" class="mt-1 block w-full text-black"
                                value="{{ old('author') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description" class="mt-1 block w-full text-black" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="publication_year"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Publication
                                Year</label>
                            <input type="text" name="publication_year" id="publication_year"
                                class="mt-1 block w-full text-black" value="{{ old('publication_year') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="category_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                            <select name="category_id" id="category_id" class="mt-1 block w-full text-black" required>
                                <option value="">Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="cover_image"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cover Image</label>
                            <input type="file" name="cover_image" id="cover_image"
                                class="mt-1 block w-full text-black">
                            <span id="file-name" class="text-sm text-gray-500 dark:text-gray-400"></span>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Add Book</button>
                            <a href="{{ route('books.index') }}" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
