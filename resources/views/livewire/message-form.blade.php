<div>
    <div class="modal fade" wire:ignore id="modal-languages" tabindex="-1" aria-labelledby="modal-languages-label" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-languages-label">Add language</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="language-wrapper">
                        @foreach($languages as $index => $language)
                        <div class="form-check">
                            <input class="form-check-input language-checkbox" @if(!empty(array_filter($chosenLanguages, function ($filterLanguage) use($language) { return $filterLanguage['id'] === $language['id']; }))) checked @endif wire:click="toggleTranslate({{ $index }})" type="checkbox">
                            <label class="form-check-label">
                                {{ $language['name'] }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btn-save-languages">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="languages-list mt-4">
        <button class="btn btn-sm btn-outline-success"
                id="btn-add-language"
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#modal-languages"
        >
            Add languages
        </button>
        @foreach($chosenLanguages as $index => $language)
            <button class="btn btn-sm btn-primary btn-language"
                    type="button"
                    wire:click.prevent="chooseTranslate({{ $index }})"
                    style="display: inline-block;"
            >
                {{ $language['name'] }}
            </button>
        @endforeach
    </div>
    <div class="translate-forms">
        @foreach($chosenLanguages as $index => $language)
            <div class="translate-form" @if($index === $chosenLanguage) style="display: block;" @endif>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" placeholder="Title" class="form-control @error("title.${language['id']}") is-invalid @enderror" value="{{ old("title.${language['id']}", $language['title'] ?? '') }}" name="title[{{ $language['id'] }}]">
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control @error("body.${language['id']}") is-invalid @enderror" placeholder="Message" name="body[{{ $language['id'] }}]" rows="3">{{ old("body.${language['id']}", $language['body'] ?? '') }}</textarea>
                </div>
            </div>
        @endforeach
    </div>
</div>
