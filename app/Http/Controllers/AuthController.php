<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // Check if AJAX request (multiple checks for reliability)
        $isAjax = $request->ajax() 
               || $request->wantsJson() 
               || $request->expectsJson()
               || $request->has('ajax')
               || $request->header('X-Requested-With') === 'XMLHttpRequest';
        
        // DEBUG - Remove after testing
        \Log::info('Login attempt', [
            'isAjax' => $isAjax,
            'has_ajax_flag' => $request->has('ajax'),
            'ajax_value' => $request->input('ajax'),
            'header_X-Requested-With' => $request->header('X-Requested-With'),
            'wantsJson' => $request->wantsJson(),
            'expectsJson' => $request->expectsJson(),
        ]);
        
        // Validasi input
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal. Periksa input Anda.',
                    'errors' => $validator->errors()
                ], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        // Cek user dan tentukan guard
        $credentials = ['email' => $request->email, 'password' => $request->password];
        $user = \App\Models\User::where('email', $request->email)->first();
        
        if (!$user) {
            if ($isAjax) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau password salah!',
                    'errors' => []
                ], 401);
            }
            return back()->withErrors(['email' => 'Email tidak ditemukan'])->withInput();
        }
        
        // Tentukan guard berdasarkan role user
        $guard = $user->role === 'admin' ? 'admin' : 'member';
        
        // Set cookie name sesuai guard SEBELUM login
        if ($guard === 'admin') {
            config(['session.cookie' => 'laravel_session_admin']);
        } else {
            config(['session.cookie' => 'laravel_session_member']);
        }
        
        // Coba login dengan guard yang sesuai
        if (Auth::guard($guard)->attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::guard($guard)->user();
            
            // Tentukan redirect URL
            $redirectUrl = $user->role === 'admin' ? '/admin/dashboard' : '/dashboard';
            
            // Return JSON untuk AJAX request
            if ($isAjax) {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil! Selamat datang kembali.',
                    'redirect' => $redirectUrl
                ]);
            }
            
            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/dashboard');
            }
        }

        // Login gagal
        if ($isAjax) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah!',
                'errors' => []
            ], 401);
        }
        
        return back()
            ->withInput($request->only('email'))
            ->with('login_status', 'error')
            ->with('login_message', 'Email atau password salah!');
    }

    /**
     * Proses login via AJAX (always return JSON)
     */
    public function loginAjax(Request $request)
    {
        // Validasi input
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal. Periksa input Anda.',
                'errors' => $validator->errors()
            ], 422);
        }

        // Coba login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Tentukan redirect URL
            $redirectUrl = $user->role === 'admin' ? url('/admin/dashboard') : url('/dashboard');
            
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil! Selamat datang kembali.',
                'redirect' => $redirectUrl
            ]);
        }

        // Login gagal
        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah!',
            'errors' => []
        ], 401);
    }

    /**
     * Tampilkan halaman register
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Proses register via AJAX (always return JSON)
     */
    public function registerAjax(Request $request)
    {
        // Validasi input
        $validator = \Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'address.required' => 'Alamat wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal. Periksa input Anda.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Buat user baru
            $user = User::create([
                'user_code' => 'MBR-' . strtoupper(\Str::random(6)),
                'role' => 'member',
                'full_name' => $request->full_name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => \Hash::make($request->password),
                'status' => 'active',
                'last_active' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil! Silakan login dengan akun Anda.',
                'redirect' => route('login')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat registrasi. Silakan coba lagi.',
                'errors' => []
            ], 500);
        }
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:20',
                'company_name' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:100',
                'province' => 'nullable|string|max:100',
                'city' => 'nullable|string|max:100',
                'district' => 'nullable|string|max:100',
                'pos_code' => 'nullable|string|max:10',
                'address' => 'nullable|string|max:500',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = Auth::user();
            $user->full_name = $request->full_name;
            $user->phone = $request->phone;
            $user->company_name = $request->company_name;
            $user->country = $request->country;
            $user->province = $request->province;
            $user->city = $request->city;
            $user->district = $request->district;
            $user->pos_code = $request->pos_code;
            $user->address = $request->address;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating profile. Please try again.',
                'errors' => []
            ], 500);
        }
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]+$/'
                ],
            ], [
                'new_password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
                'new_password.confirmed' => 'Password confirmation does not match.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = Auth::user();

            // Verify current password
            if (!\Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Current password is incorrect.',
                    'errors' => ['current_password' => ['The current password is incorrect.']]
                ], 422);
            }

            // Check if new password is same as current password
            if (\Hash::check($request->new_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'New password must be different from current password.',
                    'errors' => ['new_password' => ['New password must be different from current password.']]
                ], 422);
            }

            // Update password
            $user->password = \Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating password. Please try again.',
                'errors' => []
            ], 500);
        }
    }
}
