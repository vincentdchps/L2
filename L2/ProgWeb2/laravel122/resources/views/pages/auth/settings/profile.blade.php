@extends('layouts.app')

@section('content')
    <x-layouts.settings>
        @session('status')
            <div class="alert alert-soft alert-success flex items-center gap-1 mb-6 border-0" role="alert">
                <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                </svg>
                <span>{{ $value }}</span>
            </div>
        @endsession

        <form method="POST" action="{{ route('settings.profile.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Name Input -->
                <div>
                    <label class="label-text" for="name">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="input"
                        placeholder="Enter your name"
                        value="{{ old('name', $user->name) }}"
                        required
                        autofocus
                    />
                    @error('name')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Input -->
                <div>
                    <label class="label-text" for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="input"
                        placeholder="Enter your email"
                        value="{{ old('email', $user->email) }}"
                        required
                    />
                    @error('email')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex gap-3">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-soft btn-secondary">Cancel</button>
            </div>
        </form>

        <!-- Delete Account Section -->
        <div class="border-base-content/20 mt-8 border-t pt-8">
            <h5 class="text-base-content text-lg font-medium">Delete Account</h5>
            <div class="mt-4">
                <div class="alert alert-soft alert-warning mb-4 border-0" role="alert">
                    <h5 class="text-lg font-medium">Are you sure you want to delete your account?</h5>
                    <p>Once you delete your account, there is no going back. Please be certain.</p>
                </div>
                <form method="POST" action="{{ route('settings.profile.destroy') }}"
                      onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <div class="mb-4 flex items-center gap-2">
                        <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" id="checkboxPrimary" />
                        <label class="label-text text-base" for="checkboxPrimary">I confirm my account deactivation</label>
                    </div>
                    <button type="submit" class="btn btn-error">Deactivate Account</button>
                </form>
            </div>
        </div>
    </x-layouts.settings>
@endsection
