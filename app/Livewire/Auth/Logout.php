<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;

class Logout extends Component
{
    public $showModal = false;

    #[On('confirmLogout')]
    public function confirmLogout()
    {
        $this->showModal = true;
    }

    public function logout()
    {
        // Update last active timestamp
        if (Auth::check()) {
            $user = Auth::user();
            $user->last_active = now();
            $user->save();
        }

        // Logout user
        Auth::guard('web')->logout();

        // Invalidate session
        Session::invalidate();
        Session::regenerateToken();

        // Redirect to login page
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

    public function cancelLogout()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.auth.logout');
    }
}
