<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AddAdminController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new admin.
     */
    public function create()
    {
        // Faqat super admin (id = 1) ruxsat oladi
        if (auth()->id() !== 1) {
            return redirect()->route('contents.index')->with('error', 'Sizda bu sahifaga ruxsat yo‘q.');
        }

        return view('admin.create-admin');
    }

    /**
     * Store a newly created admin in storage.
     */
    public function store(Request $request)
    {
        // Faqat super admin (id = 1) ruxsat oladi
        if (auth()->id() !== 1) {
            return redirect()->route('contents.index')->with('error', 'Sizda admin yaratishga ruxsat yo‘q.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Rollarni belgilash (agar kerak bo‘lsa)
        $user->assignRole('admin');

        return redirect()->route('users')->with('success', 'Yangi admin yaratildi.');
    }

    public function show(string $id) { /* ... */ }

    public function edit(string $id) { /* ... */ }

    public function update(Request $request, string $id) { /* ... */ }

    public function destroy(string $id) { /* ... */ }
}
