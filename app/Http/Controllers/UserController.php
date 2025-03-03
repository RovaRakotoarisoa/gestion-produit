<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }
    // ============ D'ORIGINE ==============
    // public function store(UserRequest $request)
    // {
    //     $data = $request->validated();
    //     $data['password'] = Hash::make($data['password']);

    //     if ($request->hasFile('avatar')) {
    //         $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
    //     }

    //     User::create($data);

    //     return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès');
    // }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        User::create($validated);
        return redirect()->route('users.index');
    }



    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // ============ D'ORIGINE ==============
    // public function update(UserRequest $request, User $user)
    // {
    //     $data = $request->validated();

    //     if ($request->filled('password')) {
    //         $data['password'] = Hash::make($data['password']);
    //     } else {
    //         unset($data['password']);
    //     }

    //     if ($request->hasFile('avatar')) {
    //         // Supprimer l'ancien avatar s'il existe
    //         if ($user->avatar) {
    //             Storage::disk('public')->delete($user->avatar);
    //         }
    //         $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
    //     }

    //     $user->update($data);

    //     return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès');
    // }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        $user->update($validated);
        return redirect()->route('users.index');
    }


    public function destroy(User $user)
    {
        // Empêcher la suppression de son propre compte
        if (auth()->id() === $user->id) {
            return redirect()->route('users.index')->with('error', 'Vous ne pouvez pas supprimer votre propre compte');
        }

        // Supprimer l'avatar s'il existe
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}
