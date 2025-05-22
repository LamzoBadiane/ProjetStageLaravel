<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentProfileController extends Controller
{
    public function edit()
    {
        $student = Auth::user()->student;
        return view('etudiant.edit-profile', compact('student'));
    }

    public function update(Request $request)
    {
        // Récupération ou création du profil étudiant lié à l'utilisateur
        $student = Auth::user()->student;

        if (!$student) {
            $student = new Student([
                'user_id' => Auth::id(),
            ]);
        }

        // Validation des données avec vérification de l'existence de l'ID
        $request->validate([
            'cin' => 'nullable|string|max:20|unique:students,cin,' . ($student->id ?? 'NULL'),
            'phone' => 'nullable|string|max:20',
            'university' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:50',
            'skills' => 'nullable|string',
            'bio' => 'nullable|string|max:1000',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Remplir les champs sauf le fichier
        $student->fill($request->except('cv'));

        // Gestion de l'upload de CV
        if ($request->hasFile('cv')) {
            $path = $request->file('cv')->store('cvs', 'public');
            $student->cv_path = $path;
        }

        $student->save();

        return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
    }
    public function show()
    {
        $student = Auth::user()->student;

        if (!$student) {
            return redirect()->route('etudiant.profile.edit')->with('warning', 'Veuillez d’abord compléter votre profil.');
        }

        return view('etudiant.show-profile', compact('student'));
    }

}
