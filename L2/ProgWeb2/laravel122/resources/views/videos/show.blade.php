<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ __('Video') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-900 dark:text-zinc-100">

                    <div class='flex'>
                        <div class='w-1/3'>
                            
                        </div>
                        <div class='w-2/3 ml-4'>
                            <h1 class='font-bold text-xl'>{{ $video->title }}</h1>
                            <p>{{ $video->description }}</p>
                            <p>Release date: {{ $video->year }}</p>
                            <p class='mt-4 font-bold text-xl'>{{ $video->price }} €</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
