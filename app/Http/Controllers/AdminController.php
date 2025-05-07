<?php

namespace App\Http\Controllers;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    // Foydalanuvchini admin qilish
    public function makeAdmin(User $user)
    {
        // Faol foydalanuvchi super admin (id = 1) bo‘lishi kerak
        if (auth()->user()->id !== 1) {
            return redirect()->back()->with('error', 'Faqat Super Admin admin tayinlay oladi.');
        }

        if (!$user->hasRole('admin')) {
            $user->assignRole('admin');
        }

        return redirect()->back()->with('success', "$user->name admin sifatida tayinlandi.");
    }

    // Foydalanuvchidan adminlikni olib tashlash
    public function removeAdmin(User $user)
    {
        // Faol foydalanuvchi super admin (id = 1) bo‘lishi kerak
        if (auth()->user()->id !== 1) {
            return redirect()->back()->with('error', 'Faqat Super Admin adminlik huquqini olib tashlay oladi.');
        }

        if ($user->hasRole('admin')) {
            $user->removeRole('admin');
        }

        return redirect()->back()->with('success', "$user->name endi admin emas.");
    }
}





