<?php


namespace App\Repositories\Eloquent;


use App\Models\Tariff;
use App\Repositories\TariffRepositoryInterface;

class TariffRepository implements TariffRepositoryInterface
{

    public function getAll()
    {
        return Tariff::all();
    }

    public function getById(int $id)
    {
        return Tariff::query()
            ->findOrFail($id);
    }

    public function save($data)
    {
        return Tariff::updateOrCreate([
            'id' => $data['id'] ?? null
        ], $data);
    }

    public function getPaginated(int $paginate)
    {
        return Tariff::query()
            ->orderByDesc('id')
            ->paginate($paginate);
    }

    public function getDefault()
    {
        return Tariff::query()
            ->where('is_default', true)
            ->first();
    }
}
