<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Tariff;
use App\Repositories\TariffRepositoryInterface;
use Illuminate\Http\Request;

class TariffController extends Controller
{

    private TariffRepositoryInterface $tariffRepository;

    public function __construct(
        TariffRepositoryInterface $tariffRepository,
    )
    {
        $this->tariffRepository = $tariffRepository;
    }

    public function index()
    {
        $tariffs = $this->tariffRepository->getAll();
        return view('tariff.index', compact('tariffs'));
    }

    public function checkout($id)
    {
        $tariff = $this->tariffRepository->getById($id);
        if(!\request()->user()->can('view', $tariff)){
            abort(403);
        }
        return view('tariff.checkout', compact('tariff'));
    }

    public function proceedCheckout(CheckoutRequest $request, $id){
        $tariff = $this->tariffRepository->getById($id);
        if(!\request()->user()->can('view', $tariff)){
            abort(403);
        }
        $payload = $request->validated();
        dd($payload);
    }

}
