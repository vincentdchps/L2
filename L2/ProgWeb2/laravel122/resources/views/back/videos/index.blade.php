@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="rounded-box shadow-base-300/10 bg-base-100 w-full pb-2 shadow-md">
            <div class="flex items-center justify-between p-4 border-b border-base-200">
                <h2 class="text-lg font-semibold">{{ __('Videos') }}</h2>
                <a href="{{ route('admin.videos.create') }}" class="btn btn-sm btn-primary" title="{{ __('New') }}">
                    {{ __('New') }}
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Published') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($videos as $video)
                            <tr>
                                <td>
                                    @if($video->image)
                                        <img src="{{ asset('storage/' . $video->image) }}" alt="{{ $video->title }}" class="h-10 w-10 rounded object-cover" />
                                    @else
                                        <span class="text-base-content/50">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="font-bold">{{ $video->title }}</div>
                                </td>
                                <td>
                                    {{ Str::words($video->description, 15, '...') }}
                                </td>
                                <td>{{ $video->price }}€</td>
                                <td>
                                    <input type="checkbox" 
                                           class="checkbox" 
                                           @checked($video->is_published)
                                           disabled />
                                </td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.videos.edit', $video->id) }}" class="btn btn-xs btn-outline btn-primary" title="{{ __('Edit') }}">
                                            {{ __('Edit') }}
                                        </a>
                                        @if (auth()->user()->role === 'admin')
                                            <button class="btn btn-xs btn-outline btn-error" 
                                                    title="{{ __('Delete') }}"
                                                    onclick="event.preventDefault(); let result = confirm('{{ __('For sure ?') }}'); if (result) { document.getElementById('delete-{{ $video->id }}').submit(); }">
                                                {{ __('Delete') }}
                                            </button>
                                            <form id="delete-{{ $video->id }}" hidden
                                                  action="{{ route('admin.videos.destroy', $video->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-8">
                                    <p class="text-base-content/70">{{ __('No videos found.') }}</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $videos->links() }}
        </div>
    </div>
@endsection
