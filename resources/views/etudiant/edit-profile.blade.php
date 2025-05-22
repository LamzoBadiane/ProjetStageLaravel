<x-app-layout>
    <div class="max-w-4xl mx-auto py-10">
        <h2 class="text-2xl font-bold mb-6">Mon Profil Étudiant</h2>

        @if (session('success'))
            <div class="p-4 mb-4 text-green-800 bg-green-200 border border-green-300 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('etudiant.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            @foreach ([
                'cin' => 'CIN',
                'phone' => 'Téléphone',
                'university' => 'Université',
                'department' => 'Département',
                'level' => 'Niveau d\'étude',
                'skills' => 'Compétences',
                'bio' => 'À propos'
            ] as $name => $label)
                <div>
                    <label for="{{ $name }}" class="block font-medium text-gray-700">{{ $label }}</label>
                    @if (in_array($name, ['skills', 'bio']))
                        <textarea name="{{ $name }}" id="{{ $name }}" rows="3"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old($name, $student->$name ?? '') }}</textarea>
                    @else
                        <input type="text" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $student->$name ?? '') }}"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                    @endif
                </div>
            @endforeach

            <div>
                <label for="cv" class="block font-medium text-gray-700">CV (PDF/DOC)</label>
                <input type="file" name="cv" id="cv" class="mt-1 block w-full">
                @if ($student && $student->cv_path)
                    <p class="text-sm mt-2 text-green-600">
                        CV actuel :
                        <a href="{{ asset('storage/' . $student->cv_path) }}" target="_blank" class="underline">Télécharger</a>
                    </p>
                @endif
            </div>
            <div class="p-6">
                <button type="submit"
                    class="px-4 py-2 rounded text-white"
                    style="background-color: #2563eb !important;">
                    Mettre à jour mon profil
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
