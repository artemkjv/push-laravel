<?php

namespace App\Http\Livewire;

use App\Libraries\Helpers\ArrayHelper;
use App\Repositories\LanguageRepositoryInterface;
use Livewire\Component;

class MessageForm extends Component
{

    public $languages = [];
    public $chosenLanguages = [];
    public $title;
    public $body;
    public $chosenLanguage;

    public function render()
    {
        return view('livewire.message-form');
    }

    public function toggleTranslate($index){
        $language = $this->languages[$index];
        $key = array_search($language, $this->chosenLanguages);
        if($key){
            unset($this->chosenLanguages[$key]);
            $this->chosenLanguage = array_key_last($this->chosenLanguages);
        }
        else
            $this->chosenLanguages[] = $language;
    }

    public function chooseTranslate($index){
        $this->chosenLanguage = $index;
    }

    public function mount(LanguageRepositoryInterface $languageRepository, $title = [], $message = []){
        $allLanguages = ArrayHelper::instance()
            ->stdCollectionToArray($languageRepository->getAll());
        $this->title = $this->handleJson($title);
        $this->body = $this->handleJson($message);
        foreach ($title as $languageId => $translateTitle){
            $language = array_filter($allLanguages, function ($language) use($languageId) {
               return $language['id'] === $languageId;
            });
            $language = array_shift($language);
            $language['title'] = $translateTitle;
            $language['body'] = $message[$languageId];
            $this->chosenLanguages[] = $language;
        }
        if(empty($title)){
            $this->chosenLanguages[] = array_shift($allLanguages);
        }
        $this->languages = $allLanguages;
        $this->chosenLanguage = array_key_last($this->chosenLanguages);
    }

    private function handleJson(&$var){
        if(is_string($var)){
            $var = json_decode($var, true);
        }
        return $var;
    }

}
