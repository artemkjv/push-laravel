<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTariffRequest;
use App\Http\Requests\UpdateTariffRequest;
use App\Models\Tariff;
use App\Repositories\TariffRepositoryInterface;
use App\Services\TariffService;
use Illuminate\Http\Request;

class TariffController extends Controller
{

    private TariffRepositoryInterface $tariffRepository;
    private TariffService $tariffService;

    public function __construct(
        TariffRepositoryInterface $tariffRepository,
        TariffService $tariffService
    )
    {
        $this->tariffRepository = $tariffRepository;
        $this->tariffService = $tariffService;
    }

    public function index(){
        $tariffs = $this->tariffRepository->getPaginated(Tariff::PAGINATE);
        return view('admin.tariff.index', compact('tariffs'));
    }

    public function create(){
        return view('admin.tariff.create');
    }

    public function store(StoreTariffRequest $request){
        $payload = $request->validated();
        $this->tariffService->handleIsDefault($payload);
        $this->tariffRepository->save($payload);
        return redirect()->route('admin.tariff.index');
    }

    public function edit($id){
        $tariff = $this->tariffRepository->getById($id);
        return view('admin.tariff.edit', compact('tariff'));
    }

    public function update(UpdateTariffRequest $request, $id){
        $payload = $request->validated();
        $this->tariffService->handleIsDefault($payload);
        $tariff = $this->tariffRepository->getById($id)
            ->toArray();
        $this->tariffRepository->save(array_merge($tariff, $payload));
        return redirect()->route('admin.tariff.index');
    }

    public function destroy($id){
        $tariff = $this->tariffRepository->getById($id);
        $tariff->delete();
        return redirect()->back();
    }

}
