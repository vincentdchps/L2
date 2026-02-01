<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ __('Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-900 dark:text-zinc-100">

                    <div class="w-full">
                        <h1 class='font-bold text-xl'>{{ $book->title }}</h1>
                        <p>{{ $book->description }}</p>
                        <p>Pages: {{ $book->page }}</p>
                        <p class='mt-4 font-bold text-xl'>{{ $book->price }} €</p>
                        <p>From: <a href="{{ route('authors.show', $book->author_id) }}"
                                class="underline">{{ $book->author->firstname }} {{ $book->author->name }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>