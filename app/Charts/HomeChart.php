<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Libraries\Decoration\UserInterface;
use App\Repositories\AppRepositoryInterface;
use App\Repositories\PushTransitionRepositoryInterface;
use App\Repositories\PushUserRepositoryInterface;
use App\Repositories\SegmentRepositoryInterface;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class HomeChart extends BaseChart
{

    public ?array $middlewares = ['auth'];
    private PushTransitionRepositoryInterface $pushTransitionRepository;
    private AppRepositoryInterface $appRepository;
    private SegmentRepositoryInterface $segmentRepository;

    public function __construct(
        PushTransitionRepositoryInterface $pushTransitionRepository,
        AppRepositoryInterface $appRepository,
        SegmentRepositoryInterface $segmentRepository
    )
    {
        $this->pushTransitionRepository = $pushTransitionRepository;
        $this->appRepository = $appRepository;
        $this->segmentRepository = $segmentRepository;
    }

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $userDecorator = \Illuminate\Support\Facades\App::make(UserInterface::class);
        $apps = $this->appRepository->getByUser($userDecorator);
        $segments = $this->segmentRepository->getByUser($userDecorator);
        $transitions = $this->pushTransitionRepository->getCount($apps, $segments);
        $labels = [];
        $data = [];
        foreach ($transitions as $transition){
            $labels[] = $transition->clicked_at_date;
            $data[] = $transition->count;
        }
        return Chartisan::build()
            ->labels($labels)
            ->dataset('Push Transitions', $data);
    }
}
