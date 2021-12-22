<?php

namespace App\Http\Livewire;

use App\Libraries\Helpers\ArrayHelper;
use App\Models\FilterType;
use App\Models\Segment;
use App\Repositories\FilterTypeRepositoryInterface;
use Livewire\Component;

class SegmentForm extends Component
{

    public ?Segment $segment = null;
    public $filterTypes;
    public $filters = [];

    public function render()
    {
        return view('livewire.segment-form');
    }

    public function addFilterListener($filterTypeId, FilterTypeRepositoryInterface $filterTypeRepository){
        $filterType = $filterTypeRepository->getById($filterTypeId);
        $entities = ArrayHelper::instance()
            ->stdCollectionToArray($filterType->getRelatedEntities());
        $this->addFilter(
            $filterType,
            $entities,
            null,
            null,
            null,
            null
        );
    }

    private function addFilter(
        $filterType,
        $entities,
        $predicateId,
        $predicateName,
        $tagKey,
        $value,
    ){
        $lastKey = array_key_last($this->filters) ?? 0;
        $this->filters[$lastKey][] = [
            'filter_type' => [
                'id' => $filterType->id,
                'title' => $filterType->title,
                'description' => $filterType->description,
                'predicates' => $filterType->predicates,
                'measurement' => $filterType->measurement,
                'key_allowed' => $filterType->key_allowed,
            ],
            'entities' => $entities,
            'value' => $value,
            'tag_key' => $tagKey,
            'predicate' => [
                'predicate_id' => $predicateId,
                'predicate_name' => $predicateName,
            ],
        ];
    }

    public function addGroup(){
        $this->filters[] = [];
    }

    public function deleteFilter($filterGroupId, $filterId){
        unset($this->filters[$filterGroupId][$filterId]);
    }

    public function mount(?Segment $segment, FilterTypeRepositoryInterface $filterTypeRepository){
        $this->segment = $segment;
        $this->filterTypes = $filterTypeRepository->getAll();
        if($this->segment){
            $groupedFilters = $this->segment
                ->filters
                ->groupBy('parent_id');
            $this->fillFilters($groupedFilters);
        }
    }

    private function fillFilters($groupedFilters){
        foreach($groupedFilters as $filterGroup){
            foreach($filterGroup as $filter){
                $entities = ArrayHelper::instance()
                    ->stdCollectionToArray($filter->filterType->getRelatedEntities());
                $this->addFilter(
                    $filter->filterType,
                    $entities,
                    $filter->predicate->id,
                    $filter->predicate->name,
                    $filter->tag_key,
                    $filter->value
                );
            }
            $this->addGroup();
        }
    }

}
