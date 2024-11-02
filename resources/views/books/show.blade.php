<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-4">{{ $book->title }}</h1>
                    <div class="mb-4">
                        <strong>Author:</strong> {{ $book->author }}
                    </div>
                    <div class="mb-4">
                        <strong>Description:</strong> {{ $book->description }}
                    </div>
                    <div class="mb-4">
                        <strong>Publication Year:</strong> {{ $book->publication_year }}
                    </div>
                    <div class="mb-4">
                        <strong>Category:</strong> {{ $book->category->name ?? 'N/A' }}
                    </div>
                    <div class="mb-4">
                        <strong>Cover Image:</strong>
                        @if ($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                                class="mt-2 max-w-md h-auto rounded shadow">
                        @else
                            <p>No cover image available.</p>
                        @endif
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to List</a>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning ml-2">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger ml-2"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
