<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Afficher la liste des utilisateurs
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Afficher le formulaire pour ajouter un utilisateur
    public function create()
    {
        return view('users.create');
    }

    // Stocker un nouvel utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profilePhotoPath = null;
        if ($request->hasFile('avatar')) {
            $profilePhotoPath = $request->file('avatar')->store('avatars', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_photo_path' => $profilePhotoPath,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    // Afficher le formulaire d'édition d'un utilisateur
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    public function show($id)
    {
        // Récupère l'utilisateur par son ID
        $user = User::findOrFail($id);

        // Retourne la vue avec les détails de l'utilisateur
        return view('users.show', compact('user'));
    }

    // Mettre à jour les informations d'un utilisateur
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);

        $profilePhotoPath = $user->profile_photo_path;
        if ($request->hasFile('avatar')) {
            $profilePhotoPath = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'profile_photo_path' => $profilePhotoPath,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès!');
    }

    // Supprimer un utilisateur
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès!');
    }
}

