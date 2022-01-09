<?php

namespace App\Http\Livewire;

use App\Libraries\Helpers\ArrayHelper;
use App\Models\FilterType;
use App\Models\Segment;
use App\Repositories\FilterRepositoryInterface;
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

    public function mount(?Segment $segment, FilterTypeRepositoryInterface $filterTypeRepository, FilterRepositoryInterface $filterRepository){
        $this->segment = $segment;
        $this->filterTypes = $filterTypeRepository->getAll();
        if($this->segment){
            $parentFilters = $filterRepository->getParentsBySegment($this->segment);
            $this->fillFilters($parentFilters);
        }
    }

    private function fillFilters($parentFilters){
        foreach($parentFilters as $parentFilter){
            $this->addGroup();
            $entities = ArrayHelper::instance()
                ->stdCollectionToArray($parentFilter->filterType->getRelatedEntities());
            $this->addFilter(
                $parentFilter->filterType,
                $entities,
                $parentFilter->predicate->id,
                $parentFilter->predicate->name,
                $parentFilter->tag_key,
                $parentFilter->value
            );
            foreach($parentFilter->children as $filter){
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
        }
    }

}
