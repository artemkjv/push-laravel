<?php

namespace App\Http\Livewire\App;

use App\Models\App;
use App\Repositories\PlatformRepositoryInterface;
use Illuminate\Support\Collection;
use Livewire\Component;

class Edit extends Component
{

    public Collection $platforms;
    public App $app;
    public array $state = [
        'platforms' => []
    ];

    public function mount(
        App $app,
        PlatformRepositoryInterface $platformRepository
    ) {
        $this->platforms = $platformRepository->getAll();
        $this->app = $app;
        $this->state['platforms'] = $app->platforms->pluck('id')->toArray();
    }

    public function render()
    {
        return view('livewire.app.edit');
    }
}
