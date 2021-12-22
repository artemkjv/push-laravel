<?php

namespace App\Http\Livewire;

use App\Repositories\LanguageRepositoryInterface;
use Livewire\Component;

class MessageForm extends Component
{

    public $languages;

    public function render()
    {
        return view('livewire.message-form');
    }

    public function mount($title, $message, LanguageRepositoryInterface $languageRepository){
        $this->languages = $languageRepository->getAll();

    }

}
