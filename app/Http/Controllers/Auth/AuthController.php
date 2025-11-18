<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // Login Methods
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email/Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember = $request->boolean('remember');
        $loginField = $request->input('email');
        
        // Coba login dengan email atau username
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        if (Auth::attempt([$fieldType => $loginField, 'password' => $request->password])) {
            $request->session()->regenerate();
            
            // Redirect based on role
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard')
                    ->with('success', 'Selamat datang Admin!');
            } else {
                return redirect()->intended('/dashboard')
                    ->with('success', 'Selamat datang kembali!');
            }
        }

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password salah.');
    }

    // Register Methods
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    //buatkan fungsi auto number untuk member
    public function generateUserCode()
    {
        $lastUser = User::where('role', 'member')->orderBy('created_at', 'desc')->first();
        if (!$lastUser) {
            return 'MBR-0001';
        }

        $lastCode = $lastUser->user_code;
        $number = (int) substr($lastCode, 4) + 1;
        return 'MBR-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username|alpha_dash',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => ['required', 'confirmed', Password::min(8)],
            'address' => 'nullable|string|max:500',
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'full_name.max' => 'Nama lengkap maksimal 255 karakter.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'username.alpha_dash' => 'Username hanya boleh huruf, angka, dash dan underscore.',
            'username.max' => 'Username maksimal 50 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.required' => 'No. telepon wajib diisi.',
            'phone.max' => 'No. telepon maksimal 20 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'address.max' => 'Alamat maksimal 500 karakter.',
        ]);

        $user = User::create([
            'user_code' => $this->generateUserCode(),
            'role' => 'member',
            'full_name' => $validated['full_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'address' => $validated['address'] ?? null,
            'status' => 'active',
        ]);

        Auth::login($user);

        return redirect('/dashboard')
            ->with('success', 'Akun berhasil dibuat! Selamat datang.');
    }

    // Logout Method
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/auth/login')
            ->with('success', 'Anda berhasil logout.');
    }
}
