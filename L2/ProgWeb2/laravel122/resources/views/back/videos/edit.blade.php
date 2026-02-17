@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="bg-base-100 shadow-base-300/20 w-full space-y-6 rounded-xl p-6 shadow-md lg:p-8">
            <div>
                <h3 class="text-base-content mb-1.5 text-2xl font-semibold">{{ __('Edit Video') }}</h3>
                <p class="text-base-content/80">{{ __('Update video information') }}</p>
            </div>

            <form action="{{ route('admin.videos.update', $video->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label class="label-text" for="title">{{ __('Title') }}*</label>
                    <input type="text" name="title" id="title" placeholder="{{ __('Enter title') }}" class="input @error('title') input-error @enderror" value="{{ old('title', $video->title) }}" required autofocus />
                    @error('title')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="label-text" for="description">{{ __('Description') }}</label>
                    <textarea id="description" name="description" placeholder="{{ __('Enter description') }}" class="textarea textarea-bordered @error('description') textarea-error @enderror w-full">{{ old('description', $video->description) }}</textarea>
                    @error('description')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label class="label-text" for="image">{{ __('Image') }}</label>
                    <input type="file" name="image" id="image" class="file-input file-input-bordered w-full @error('image') file-input-error @enderror" />
                    @error('image')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Year -->
                <div>
                    <label class="label-text" for="year">{{ __('Year') }}*</label>
                    <input type="text" name="year" id="year" placeholder="{{ __('Enter year') }}" class="input @error('year') input-error @enderror" value="{{ old('year', $video->year) }}" required />
                    @error('year')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label class="label-text" for="price">{{ __('Price') }}*</label>
                    <input type="text" name="price" id="price" placeholder="{{ __('Enter price') }}" class="input @error('price') input-error @enderror" value="{{ old('price', $video->price) }}" required />
                    @error('price')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- is_published -->
                <div>
                    <label class="label cursor-pointer gap-3">
                        <input type="checkbox" name="is_published" value="1" class="checkbox" @checked(old('is_published', $video->is_published)) />
                        <span class="label-text">{{ __('Is published') }}</span>
                    </label>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="btn btn-lg btn-primary btn-gradient">
                        {{ __('Update') }}
                    </button>

                    <a href="{{ route('admin.videos.index') }}" class="btn btn-lg btn-outline">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection