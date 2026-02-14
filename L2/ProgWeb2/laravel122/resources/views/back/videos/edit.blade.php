<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ __('Edit Video') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-900 dark:text-zinc-100">
                    <form method="POST" action="{{ route('admin.videos.update', $video->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="old('title', $video->title)" required autofocus autocomplete="title" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description"
                                class="border-zinc-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 focus:border-slate-500 dark:focus:border-slate-600 focus:ring-slate-500 dark:focus:ring-slate-600 rounded-md shadow-sm' block mt-1 w-full"
                                name="description" autocomplete="description">{{ old('description', $video->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Image -->
                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Image')" />
                            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image"
                                :value="old('image')" autocomplete="image" />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <!-- Year -->
                        <div class="mt-4">
                            <x-input-label for="year" :value="__('Year')" />
                            <x-text-input id="year" class="block mt-1 w-full" type="text" name="year"
                                :value="old('year', $video->year)" required autocomplete="year" />
                            <x-input-error :messages="$errors->get('year')" class="mt-2" />
                        </div>

                        <!-- Price -->
                        <div class="mt-4">
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="text" name="price"
                                :value="old('price', $video->price)" required autocomplete="price" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <!-- is_published -->
                        <div class="block mt-4">
                            <label for="is_published" class="inline-flex items-center">
                                <input id="is_published" type="checkbox"
                                    class="rounded dark:bg-zinc-900 border-zinc-300 dark:border-zinc-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-zinc-800"
                                    name="is_published" value="1" @checked(old('is_published', $video->is_published))>
                                <span class="ms-2 text-sm text-zinc-600 dark:text-zinc-400">Is published</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>