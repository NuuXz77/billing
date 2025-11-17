<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;

#[Layout('components.layouts.guest')]
#[Title('Register')]
class Register extends Component
{
    #[Validate('required|string|max:255', message: 'Nama lengkap wajib diisi')]
    public $full_name = '';

    #[Validate('required|string|max:255|unique:users,username', message: [
        'required' => 'Username wajib diisi',
        'unique' => 'Username sudah digunakan'
    ])]
    public $username = '';

    #[Validate('required|email|unique:users,email', message: [
        'required' => 'Email wajib diisi',
        'email' => 'Format email tidak valid',
        'unique' => 'Email sudah terdaftar'
    ])]
    public $email = '';

    #[Validate('required|string', message: 'Kecamatan wajib diisi')]
    public $district = '';

    #[Validate('required|string', message: 'Kota wajib diisi')]
    public $city = '';

    #[Validate('required|string', message: 'Provinsi wajib diisi')]
    public $province = '';

    #[Validate('required|string', message: 'Kode pos wajib diisi')]
    public $pos_code = '';

    #[Validate('nullable|string|max:255')]
    public $company_name = '';

    #[Validate('required|string', message: 'Alamat wajib diisi')]
    public $address = '';

    #[Validate('required|confirmed', message: [
        'required' => 'Password wajib diisi',
        'confirmed' => 'Konfirmasi password tidak cocok'
    ])]
    public $password = '';

    public $password_confirmation = '';

    public function register()
    {
        // Additional password strength validation
        $this->validate([
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ], [
            'password.min' => 'Password minimal 8 karakter dengan kombinasi huruf besar, kecil, dan angka',
        ]);

        try {
            // Create User with all fields
            $user = User::create([
                'user_code' => 'USR-' . strtoupper(uniqid()),
                'role' => 'member',
                'email' => $this->email,
                'full_name' => $this->full_name,
                'username' => $this->username,
                'password' => Hash::make($this->password),
                'address' => $this->address,
                'district' => $this->district,
                'city' => $this->city,
                'province' => $this->province,
                'pos_code' => $this->pos_code,
                'country' => 'Indonesia',
                'company_name' => $this->company_name,
                'status' => 'active',
                'last_active' => now(),
            ]);

            // Login the user
            Auth::login($user);

            // Redirect based on role
            return redirect()->intended('/dashboard');
        } catch (\Exception $e) {
            session()->flash('error', 'Pendaftaran gagal: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
