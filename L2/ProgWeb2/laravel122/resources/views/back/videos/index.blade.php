<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ __('Videos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-900 dark:text-zinc-100">


                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
                            <thead
                                class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Title
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Published
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <a class="btn-new ml-3 mb-2"
                                       href="{{ route('admin.videos.create') }}"
                                       title="{{ __('New') }}">{{ __('New') }}</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($videos as $video)
                                <tr class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700 border-zinc-200">
                                    <th scope="row"
                                        class="px-6 py-4 ">
                                        {{ $video->id }}
                                    </th>
                                    <td class="px-6 py-4 font-medium text-zinc-900 whitespace-nowrap dark:text-white">
                                        
                                    </td>
                                    <td class="px-6 py-4 font-medium text-zinc-900 whitespace-nowrap dark:text-white">
                                        {{ $video->title }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-zinc-900 dark:text-white">
                                        {{ Str::words($video->description, 20, '...') }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-zinc-900 whitespace-nowrap dark:text-white">
                                        {{ $video->price }}€
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.videos.published', $video->id) }}" title="active">
                                            <i class="fa-solid {{ $video->is_published ? 'text-green-600' : 'text-red-600' }} fa-check"></i>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 flex">
                                        <a class="btn-std ml-3"
                                           href="{{ route('admin.videos.edit', $video->id) }}"
                                           title="{{ __('Edit') }}">Edit</a>
                                        @if (auth()->user()->role === 'su')
                                            <a class="btn-danger ml-3"
                                               href=""
                                               title="{{ __('Delete') }}"
                                               onclick="event.preventDefault(); let result = confirm('{{ __('Are you sure you want to delete this item?') }}'); if (result) { document.getElementById('delete-{{ $video->id }}').submit(); }">{{ __('Delete') }}</a>
                                            <form id="delete-{{ $video->id }}" hidden
                                                  action="{{ route('admin.videos.destroy', $video->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>

                    </div>
                    <div class="mt-4">
                        {{ $videos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
