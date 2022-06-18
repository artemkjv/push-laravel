<?php

namespace App\Http\Livewire\App;

use App\Repositories\PlatformRepositoryInterface;
use Illuminate\Support\Collection;
use Livewire\Component;

class Create extends Component
{


    public array $state = [
        'platform' => 0
    ];

    public Collection $platforms;

    public function mount(
        PlatformRepositoryInterface $platformRepository
    ) {
        $this->platforms = $platformRepository->getAll();
        $this->state['platform'] = old('platform_id', 0);
    }

    public function render()
    {
        return view('livewire.app.create');
    }
}
