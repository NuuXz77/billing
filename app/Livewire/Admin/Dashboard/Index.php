<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Beranda')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard.index');
    }
}
