<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;
use App\Models\Regency;

class RegencySelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
    {
        return Regency::query()
            ->when($this->hasDependency('province_id'), function ($query) {
                $query->where('province_id', $this->getDependingValue('province_id'));
            })
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('name', 'like', "%$searchTerm%");
            })
            ->get()
            ->map(function (Regency $regency) {
                return [
                    'value' => $regency->id,
                    'description' => $regency->name,
                ];
            });
    }

    public function selectedOption($value)
    {
        $regency = Regency::find($value);

        // return [
        //     'title' => optional($regency)->name,
        // ];
        return [
            'value' => optional($regency)->id,
            'description' => optional($regency)->name,
        ];
    }
}