@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        @session('success')
            <x-ui.alert variant="success">
                {{ $value }}
            </x-ui.alert>
        @endsession

        <div class="rounded-box shadow-base-300/10 bg-base-100 w-full pb-2 shadow-md">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Year</th>
                            <th>Price</th>
                            <th>Published</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($videos as $video)
                            <tr>
                                <td>{{ $video->title }}</td>
                               <td>
                                    @if($video->image)
                                        <img src="{{ $video->image }}" alt="Video Image" class="size-9 rounded-full">
                                    @else
                                        <span class="text-base-content/50">-</span>
                                    @endif
                                </td>
                                <td>{{ $video->year }}</td>
                                <td>{{ $video->price }}</td>
                                <td>{{ $video->is_published ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a href="{{ route('videos.edit', $video) }}" class="btn btn-circle btn-text btn-sm" aria-label="Edit video">
                                        <span class="icon-[tabler--pencil] size-5"></span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8">
                                   <p class="text-base-content/70">No videos found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($videos->hasPages())
            <div class="mt-4">
                {{ $videos->links() }}
            </div>
        @endif
    </div>
@endsection

