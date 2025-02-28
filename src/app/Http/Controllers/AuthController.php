<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole(Auth::user());
        }
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Special case for admin
        if ($credentials['email'] === 'admin@admin.com' && $credentials['password'] === 'admin') {
            $admin = User::where('email', 'admin@admin.com')->first();
            
            if (!$admin) {
                // Create admin user if it doesn't exist
                $admin = User::create([
                    'uuid' => \Str::uuid(),
                    'name' => 'Admin',
                    'surname' => 'User',
                    'site' => 'HQ',
                    'email' => 'admin@admin.com',
                    'password' => Hash::make('admin'),
                    'role' => 'admin'
                ]);
            }
            
            Auth::login($admin);
            return redirect('/admin');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->redirectBasedOnRole(Auth::user());
        }

        return back()->with('error', 'Invalid credentials');
    }

    private function redirectBasedOnRole($user)
    {
        if ($user->role === 'admin') {
            return redirect('/admin');
        } elseif ($user->role === 'agent') {
            return redirect('/agent/requests');
        }
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
} 