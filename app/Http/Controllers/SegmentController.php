<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSegmentRequest;
use App\Http\Requests\UpdateSegmentRequest;
use App\Libraries\Decoration\UserInterface;
use App\Models\Segment;
use App\Repositories\FilterRepositoryInterface;
use App\Repositories\SegmentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SegmentController extends Controller
{

    private SegmentRepositoryInterface $segmentRepository;
    private FilterRepositoryInterface $filterRepository;

    public function __construct(
        SegmentRepositoryInterface $segmentRepository,
        FilterRepositoryInterface $filterRepository
    )
    {
        $this->segmentRepository = $segmentRepository;
        $this->filterRepository = $filterRepository;
    }

    public function index(){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $segments = $this->segmentRepository->getByUserPaginated(
            $userDecorator,
            request()->get('limit') ?? Segment::PAGINATE,
            request()->get('search')
        );
        return view('segment.index', compact('segments'));
    }

    public function create(){
        return view('segment.create');
    }

    public function store(StoreSegmentRequest $request){
        $this->authorize('create', Segment::class);
        $validated = $request->validated();
        DB::transaction(function () use ($validated){
            $segment = $this->segmentRepository->save([
                'name' => $validated['name'],
            ]);
            $this->saveFilters($validated['group'], $segment);
        });
        return redirect()->route('segment.index');
    }

    public function edit($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $segment = $this->segmentRepository->getByIdAndUser($id, $userDecorator);
        return view('segment.edit', compact('segment'));
    }

    public function update(UpdateSegmentRequest $request, $id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $segment = $this->segmentRepository
            ->getByIdAndUser($id, $userDecorator);
        $validated = $request->validated();
        DB::transaction(function () use ($validated, $segment){
            $segment->filters()->delete();
            $segment = $segment->toArray();
            $segment['name'] = $validated['name'];
            $segment = $this->segmentRepository->save($segment);
            $this->saveFilters($validated['group'], $segment);
        });
        return redirect()->route('segment.index');
    }

    private function saveFilters($group, $segment){
        foreach ($group as $filters){
            $parentFilter = array_shift($filters);
            $parentFilter['segment_id'] = $segment->id;
            $parentFilter = $this->filterRepository->save($parentFilter);
            foreach ($filters as $filter){
                $filter['segment_id'] = $segment->id;
                $filter['parent_id'] = $parentFilter->id;
                $this->filterRepository->save($filter);
            }
        }
    }

    public function destroy($id){
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $segment = $this->segmentRepository->getByIdAndUser($id, $userDecorator);
        $this->authorize('delete', $segment);
        $segment->delete();
        return redirect()->back();
    }

}
