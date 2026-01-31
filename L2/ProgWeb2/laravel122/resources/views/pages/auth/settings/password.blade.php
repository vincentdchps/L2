@extends('layouts.app')

@section('content')
    <x-layouts.settings>
        @if (session('status') === 'password-updated')
            <div class="alert alert-soft alert-success mb-6 border-0" role="alert">
                <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                </svg>
                <span>Password updated successfully</span>
            </div>
        @endif

        <form method="POST" action="{{ route('settings.password.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Current Password Input -->
                <div class="md:col-span-2">
                    <label class="label-text" for="current_password">Current Password</label>
                    <div x-data="{ showPassword: false }" class="relative">
                        <input
                            :type="showPassword ? 'text' : 'password'"
                            id="current_password"
                            name="current_password"
                            class="input pr-11"
                            placeholder="Enter your current password"
                            required
                        />
                        <span @click="showPassword = !showPassword"
                            class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer">
                            <span x-show="!showPassword" class="icon-[tabler--eye] size-5 text-base-content/80"></span>
                            <span x-show="showPassword" class="icon-[tabler--eye-off] size-5 text-base-content/80"></span>
                        </span>
                    </div>
                    @error('current_password')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password Input -->
                <div>
                    <label class="label-text" for="password">New Password</label>
                    <div x-data="{ showPassword: false }" class="relative">
                        <input
                            :type="showPassword ? 'text' : 'password'"
                            id="password"
                            name="password"
                            class="input pr-11"
                            placeholder="Enter your new password"
                            required
                        />
                        <span @click="showPassword = !showPassword"
                            class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer">
                            <span x-show="!showPassword" class="icon-[tabler--eye] size-5 text-base-content/80"></span>
                            <span x-show="showPassword" class="icon-[tabler--eye-off] size-5 text-base-content/80"></span>
                        </span>
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Input -->
                <div>
                    <label class="label-text" for="password_confirmation">Confirm Password</label>
                    <div x-data="{ showPassword: false }" class="relative">
                        <input
                            :type="showPassword ? 'text' : 'password'"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="input pr-11"
                            placeholder="Confirm your new password"
                            required
                        />
                        <span @click="showPassword = !showPassword"
                            class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer">
                            <span x-show="!showPassword" class="icon-[tabler--eye] size-5 text-base-content/80"></span>
                            <span x-show="showPassword" class="icon-[tabler--eye-off] size-5 text-base-content/80"></span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex gap-3">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-soft btn-secondary">Cancel</button>
            </div>
        </form>
    </x-layouts.settings>
@endsection
