@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Titre -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold mb-2">Nous contacter</h1>
        <p class="text-gray-600">Envoyez-nous un message et nous répondrons rapidement.</p>
    </div>

    <!-- Erreurs -->
    @if ($errors->any())
        <div class="alert alert-error mb-6">
            <div class="flex gap-3">
                <svg class="h-6 w-6 shrink-0 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 0v2m0-6v2m0-12V7a4 4 0 015.732.732l2.536 2.536A4 4 0 0121 9a4 4 0 01-4 4h-1.6"></path>
                </svg>
                <div>
                    <h3 class="font-bold">Erreur de validation</h3>
                    <ul class="text-sm list-disc list-inside mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Succès -->
    @if (session('success'))
        <div class="alert alert-success mb-6">
            <div class="flex gap-3">
                <svg class="h-6 w-6 shrink-0 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Formulaire -->
    <form method="POST" action="{{ route('contact.submit') }}" class="card bg-base-100 shadow-lg">
        <div class="card-body">
            @csrf

            <!-- Sujet -->
            <div class="form-control w-full">
                <label class="label" for="title">
                    <span class="label-text text-lg font-semibold">Sujet</span>
                </label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    placeholder="Quel est le sujet de votre message ?" 
                    class="input input-bordered w-full {{ $errors->has('title') ? 'input-error' : '' }}"
                    required
                >
                @if ($errors->has('title'))
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $errors->first('title') }}</span>
                    </label>
                @endif
            </div>

            <!-- Message -->
            <div class="form-control w-full mt-6">
                <label class="label" for="message">
                    <span class="label-text text-lg font-semibold">Message</span>
                </label>
                <textarea 
                    name="message" 
                    id="message" 
                    placeholder="Décrivez votre message..."
                    rows="6"
                    class="textarea textarea-bordered w-full {{ $errors->has('message') ? 'textarea-error' : '' }}"
                    required
                ></textarea>
                @if ($errors->has('message'))
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $errors->first('message') }}</span>
                    </label>
                @endif
            </div>

            <!-- Bouton -->
            <div class="card-actions justify-end mt-8">
                <button type="submit" class="btn btn-primary btn-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Envoyer
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
