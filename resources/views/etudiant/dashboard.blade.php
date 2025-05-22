<x-app-layout>
    <div class="container">
        <!-- Header principal -->
        <div class="header">
            <h1>🎓 Bienvenue, {{ Auth::user()->name }} !</h1>
            <p>Votre espace personnel pour gérer vos candidatures, votre profil et suivre vos opportunités.</p>
        </div>

        @php
            $student = Auth::user()->student;
        @endphp

        @if (!$student)
            <!-- Bloc profil non créé -->
            <div class="alert-warning">
                <h2>⚠️ Profil incomplet</h2>
                <p>Veuillez créer votre profil étudiant pour accéder à toutes les fonctionnalités de la plateforme.</p>
                <div class="center-btn">
                    <a href="{{ route('etudiant.profile.edit') }}" class="btn yellow">➕ Créer mon profil maintenant</a>
                </div>
            </div>

        @else
            <!-- Actions principales AVANT les détails -->
            <div class="actions">
                <a href="{{ route('etudiant.profile.edit') }}" class="btn indigo">✏ Modifier mon profil</a>
                <a href="#" class="btn gray">📂 Mes candidatures (bientôt)</a>
                <a href="#" class="btn teal">🔍 Rechercher des offres (bientôt)</a>
            </div>

            <!-- Statistiques -->
            <div class="stats">
                <div class="card">
                    <div class="icon blue">📄</div>
                    <div>
                        <p class="label">CV</p>
                        <p class="value">{{ $student->cv_path ? 'Déposé' : 'Non déposé' }}</p>
                    </div>
                </div>
                <div class="card">
                    <div class="icon green">🎓</div>
                    <div>
                        <p class="label">Niveau</p>
                        <p class="value">{{ $student->level ?? 'Non renseigné' }}</p>
                    </div>
                </div>
                <div class="card">
                    <div class="icon purple">🧠</div>
                    <div>
                        <p class="label">Compétences</p>
                        <p class="value">{{ $student->skills ?? 'Non renseigné' }}</p>
                    </div>
                </div>
            </div>

            <!-- Détail du profil -->
            <div class="profile">
                <h2>📌 Détails de votre profil</h2>
                <div class="grid">
                    <div><strong>👤 Nom :</strong> {{ Auth::user()->name }}</div>
                    <div><strong>📧 Email :</strong> {{ Auth::user()->email }}</div>
                    <div><strong>🪪 CIN :</strong> {{ $student->cin ?? '—' }}</div>
                    <div><strong>📱 Téléphone :</strong> {{ $student->phone ?? '—' }}</div>
                    <div><strong>🏫 Université :</strong> {{ $student->university ?? '—' }}</div>
                    <div><strong>🏛 Département :</strong> {{ $student->department ?? '—' }}</div>
                    <div><strong>🎓 Niveau :</strong> {{ $student->level ?? '—' }}</div>
                    <div><strong>🧠 Compétences :</strong> {{ $student->skills ?? '—' }}</div>
                    <div class="full">
                        <strong>📝 Bio :</strong>
                        <p class="bio">{{ $student->bio ?? '—' }}</p>
                    </div>
                    <div class="full">
                        <strong>📎 CV :</strong>
                        @if ($student->cv_path)
                            <a href="{{ asset('storage/' . $student->cv_path) }}" target="_blank" class="cv-link">📥 Télécharger mon CV</a>
                        @else
                            <span class="text-red">Non déposé</span>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        <!-- Pied de page -->
        <footer class="footer">
            &copy; {{ date('Y') }} Plateforme de Gestion des Candidatures Étudiantes. Tous droits réservés.
        </footer>
    </div>
</x-app-layout>

<style>
/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes zoomIn {
    from { transform: scale(0.95); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

/* Layout */
body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to bottom, #f5f5f5, #fff);
    margin: 0;
    padding: 0;
}
.container {
    padding: 50px 30px;
    max-width: 1200px;
    margin: auto;
    animation: fadeIn 0.8s ease-out;
}

/* Header */
.header {
    text-align: center;
    margin-bottom: 50px;
    animation: zoomIn 1s ease-out;
}
.header h1 {
    font-size: 3em;
    color: #4c51bf;
    text-shadow: 2px 2px #e0e0e0;
}
.header p {
    font-size: 1.2em;
    color: #555;
}

/* Alert */
.alert-warning {
    background: #fffbea;
    border-left: 5px solid #f6ad55;
    padding: 20px;
    border-radius: 10px;
    color: #744210;
    margin-bottom: 30px;
    animation: fadeIn 0.6s ease-out;
}

/* Buttons */
.actions {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    margin-bottom: 40px;
    animation: fadeIn 0.6s ease-in;
}
.btn {
    padding: 15px 30px;
    font-size: 1.1em;
    font-weight: bold;
    border-radius: 30px;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.btn:hover {
    transform: scale(1.05);
}
.btn.indigo {
    background: linear-gradient(to right, #5a67d8, #434190);
    color: white;
}
.btn.gray {
    background: linear-gradient(to right, #e2e8f0, #a0aec0);
    color: #2d3748;
}
.btn.teal {
    background: linear-gradient(to right, #38b2ac, #2c7a7b);
    color: white;
}
.btn.yellow {
    background: #f6e05e;
    color: black;
}

/* Cards */
.stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-bottom: 50px;
}
.card {
    background: white;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    display: flex;
    gap: 15px;
    align-items: center;
    transition: transform 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
}
.icon {
    font-size: 2em;
    color: white;
    padding: 15px;
    border-radius: 50%;
}
.icon.blue { background-color: #3182ce; }
.icon.green { background-color: #38a169; }
.icon.purple { background-color: #805ad5; }
.label {
    font-size: 0.9em;
    color: #888;
}
.value {
    font-size: 1.3em;
    font-weight: bold;
}

/* Profile section */
.profile {
    background: white;
    padding: 40px;
    border-radius: 30px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.05);
    animation: fadeIn 1s ease-out;
}
.profile h2 {
    color: #4c51bf;
    font-size: 1.8em;
    margin-bottom: 20px;
}
.grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}
.grid .full {
    grid-column: span 2;
}
.bio {
    font-style: italic;
    color: #666;
}
.cv-link {
    margin-left: 10px;
    color: #3182ce;
    text-decoration: underline;
}
.cv-link:hover {
    color: #2b6cb0;
}
.text-red {
    color: #e53e3e;
}
.center-btn {
    margin-top: 25px;
    display: flex;
    justify-content: center;
}
.footer {
    margin-top: 60px;
    padding: 20px 10px;
    text-align: center;
    font-size: 0.9em;
    color: #888;
    border-top: 1px solid #e2e8f0;
    animation: fadeIn 1s ease-out;
}
</style>
