<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h2 class="text-2xl font-bold mb-6">Fiche Profil Étudiant</h2>

        <div class="bg-white shadow-md rounded p-6 space-y-4">
            <div>
                <span class="font-bold">Nom :</span> {{ Auth::user()->name }}
            </div>

            <div>
                <span class="font-bold">Email :</span> {{ Auth::user()->email }}
            </div>

            <div>
                <span class="font-bold">CIN :</span> {{ $student->cin ?? 'Non renseigné' }}
            </div>

            <div>
                <span class="font-bold">Téléphone :</span> {{ $student->phone ?? 'Non renseigné' }}
            </div>

            <div>
                <span class="font-bold">Université :</span> {{ $student->university ?? 'Non renseigné' }}
            </div>

            <div>
                <span class="font-bold">Département :</span> {{ $student->department ?? 'Non renseigné' }}
            </div>

            <div>
                <span class="font-bold">Niveau :</span> {{ $student->level ?? 'Non renseigné' }}
            </div>

            <div>
                <span class="font-bold">Compétences :</span> {{ $student->skills ?? 'Non renseigné' }}
            </div>

            <div>
                <span class="font-bold">À propos :</span>
                <p class="mt-1 text-gray-700">{{ $student->bio ?? 'Non renseigné' }}</p>
            </div>

            <div>
                <span class="font-bold">CV :</span>
                @if ($student->cv_path)
                    <a href="{{ asset('storage/' . $student->cv_path) }}" target="_blank" class="text-blue-600 underline">
                        Voir le CV
                    </a>
                @else
                    <span class="text-red-500">Non déposé</span>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
