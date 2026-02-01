<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ __('Author') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-900 dark:text-zinc-100">

                    <div class="w-full">
                        <h1 class='font-bold text-xl'>{{ $author->firstname }} {{ $author->name }}</h1>
                        <p>{{ $author->biography }}</p>
                        @if ($author->books()->count() > 0)
                            @foreach ($author->books as $book)
                                <p><a href='{{ route('books.show', $book->id) }}' class='underline'>{{ $book->title }}</a></p>
                            @endforeach
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>