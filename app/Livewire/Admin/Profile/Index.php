<?php

namespace App\Livewire\Admin\Profile;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Profile')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.profile.index');
    }
}
