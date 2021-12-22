<div class="row">
    @if(count($filterTypes))
        <div class="filter-types col-xl-6 col-sm-12">
            @foreach($filterTypes as $filterType)
                <a type="button" wire:click.prevent="addFilterListener({{ $filterType->id }})" class="filter-type mt-2 non-underline">
                    <div class="filter-type-title">
                        {{ $filterType->title }}
                    </div>
                    <div class="filter-type-description">
                        {{ $filterType->description }}
                    </div>
                    <div class="filter-type-action">
                        +
                    </div>
                </a>
            @endforeach
        </div>
    @endif
    @if($filters)
    <div class="filters col-xl-6 col-sm-12">
            @foreach($filters as $filterGroupIndex => $filterGroup)
                <div class="filter-group">
                @foreach($filterGroup as $filterIndex => $filter)
                    <div class="filter">
                        <div class="filter-title">
                            {{ $filter['filter_type']['title'] }}
                        </div>
                        <input type="hidden" name="group[{{ $filterGroupIndex }}][{{ $filterIndex }}][filter_type_id]" value="{{ $filter['filter_type']['id'] }}">
                        <div class="filter-values">
                            <select class="form-control" name="group[{{ $filterGroupIndex }}][{{ $filterIndex }}][predicate_id]">
                                @foreach($filter['filter_type']['predicates'] as $predicate)
                                    <option value="{{ $predicate['id'] }}">
                                        {{ $predicate['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @if($filter['entities'])
                                <select class="form-control" name="group[{{ $filterGroupIndex }}][{{ $filterIndex }}][value]">
                                    @foreach($filter['entities'] as $entity)
                                        <option @if($filter['value'] == $entity['id']) selected @endif value="{{ $entity['id'] }}">
                                            {{ $entity['name'] }}
                                        </option>
                                    @endforeach
                                    {{ print_r($filter['entities']) }}
                                </select>
                            @else
                                @if($filter['filter_type']['key_allowed'])
                                    <input type="text" class="form-control" value="{{ $filter['tag_key'] }}" name="group[{{ $filterGroupIndex }}][{{ $filterIndex }}][tag_key]">
                                @endif
                                <input type="text" class="form-control" value="{{ $filter['value'] }}" name="group[{{ $filterGroupIndex }}][{{ $filterIndex }}][value]">
                                <span>{{ $filter['filter_type']['measurement'] }}</span>
                            @endif
                        </div>
                        <div class="filter-action">
                            <ion-icon name="close" class="action-icon"
                                      wire:click.prevent="deleteFilter('{{ $filterGroupIndex }}', '{{ $filterIndex }}')"
                            ></ion-icon>
                        </div>
                    </div>
                @endforeach
                </div>
            @endforeach
                <button type="button" class="btn btn-secondary" wire:click.prevent="addGroup()" style="display: inline-block;">Add or</button>
    </div>
    @endif
</div>
