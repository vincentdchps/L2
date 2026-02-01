@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div class="rounded-box shadow-base-300/10 bg-base-100 w-full pb-2 shadow-md">
            <div class="flex items-center justify-between p-4 border-b border-base-200">
                <h2 class="text-lg font-semibold">Liste des Livres</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Pages</th>
                            <th>Prix</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr>
                                <td>
                                    <div class="font-bold">{{ $book->title }}</div>
                                    <div class="text-xs opacity-50">{{ $book->is_published ? 'Publié' : 'Non publié' }}</div>
                                </td>
                                
                                <td>
                                    @if($book->author)
                                        {{ $book->author->firstname }} {{ $book->author->name }}
                                    @else
                                        <span class="text-error">Aucun auteur</span>
                                    @endif
                                </td>

                                <td>{{ $book->page }} p.</td>
                                <td>{{ $book->price }} €</td>
                                
                                <td>
                                    <button class="btn btn-circle btn-text btn-sm" aria-label="Details">
                                        <span class="icon-[tabler--eye] size-5"></span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8">
                                    <p class="text-base-content/70">Aucun livre trouvé.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $books->links() }}
        </div>
    </div>
@endsection