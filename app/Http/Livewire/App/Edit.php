<?php

namespace App\Http\Livewire\App;

use App\Models\App;
use App\Repositories\PlatformRepositoryInterface;
use Illuminate\Support\Collection;
use Livewire\Component;
use function Livewire\str;

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
        $chosenPlatforms = $app->platforms->pluck('id')->toArray();
        foreach ($chosenPlatforms as $chosenPlatform) {
            $this->state['platforms'][] = (string) $chosenPlatform;
        }
    }

    public function render()
    {
        return view('livewire.app.edit');
    }
}
