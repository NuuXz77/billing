<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.guest')]
#[Title('Login')]
class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;
    public $toastMessage = '';
    public $toastType = ''; // 'success' or 'error'

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    protected $messages = [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 6 karakter.',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();

            $user = Auth::user();

            // Update last_active
            $user->last_active = now();
            $user->save();

            // Set toast success
            $this->toastMessage = 'Login berhasil! Selamat datang kembali.';
            $this->toastType = 'success';

            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/dashboard');
            }
        }

        // Set toast error
        $this->toastMessage = 'Email atau password salah!';
        $this->toastType = 'error';
        $this->addError('email', 'Email atau password salah.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
