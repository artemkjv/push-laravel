<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSegmentRequest;
use App\Http\Requests\UpdateSegmentRequest;
use App\Libraries\Decoration\UserInterface;
use App\Libraries\Decoration\UserWrapper;
use App\Models\Segment;
use App\Repositories\FilterRepositoryInterface;
use App\Repositories\SegmentRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SegmentController extends Controller
{

    private SegmentRepositoryInterface $segmentRepository;
    private FilterRepositoryInterface $filterRepository;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        SegmentRepositoryInterface $segmentRepository,
        FilterRepositoryInterface $filterRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->segmentRepository = $segmentRepository;
        $this->filterRepository = $filterRepository;
        $this->userRepository = $userRepository;
    }

    public function index(){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $segments = $this->segmentRepository->getByUserPaginated(
            $userDecorator,
            request()->get('limit') ?? Segment::PAGINATE,
            request()->get('search')
        );
        return view('admin.segment.index', compact('segments', 'user'));
    }

    public function create(){
        $user = \request()->currentUser;
        return view('admin.segment.create', compact('user'));
    }

    public function store(StoreSegmentRequest $request){
        $user = \request()->currentUser;
        $validated = $request->validated();
        DB::transaction(function () use ($validated, $user){
            $segment = $this->segmentRepository->save([
                'name' => $validated['name'],
            ]);
            $this->saveFilters($validated['group'], $segment);
        });
        return redirect()->route('admin.segment.index', ['userId' => $user->id]);
    }

    public function edit($userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
        $segment = $this->segmentRepository->getByIdAndUser($id, $userDecorator);
        return view('admin.segment.edit', compact('segment', 'user'));
    }

    public function update(UpdateSegmentRequest $request, $userId, $id){
        $user = \request()->currentUser;
        $userDecorator = new UserWrapper($user);
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
        return redirect()->route('admin.segment.index', ['userId' => $user->id]);
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

    public function destroy($userId, $id){
        $userDecorator = new UserWrapper(\request()->currentUser);
        $segment = $this->segmentRepository->getByIdAndUser($id, $userDecorator);
        $this->authorize('delete', $segment);
        $segment->delete();
        return redirect()->back();
    }

}
