<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Asantibanez\LivewireSelect\LivewireSelect;
use App\Models\Province;
use Illuminate\Support\Collection;

class ProvinceSelect extends LivewireSelect
{
    // public function render()
    // {
    //     return view('livewire.province-select');
    // }

    public function options($searchTerm = null) : Collection
    {
        return Province::query()
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('name', 'like', "%$searchTerm%");
            })
            ->orderBy('name')
            ->get()
            ->map(function (Province $province) {
                return [
                    'value' => $province->id,
                    'description' => $province->name,
                ];
            });
    }

    public function selectedOption($value = null)
    {
        $province = Province::find($value);

        return [
            'value' => $province->id,
            'description' => $province->name,
        ];
    }
}
