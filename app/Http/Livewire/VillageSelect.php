<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;
use App\Models\Village;

class VillageSelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
    {
        return Village::query()
            ->when($this->hasDependency('district_id'), function ($query) {
                $query->where('district_id', $this->getDependingValue('district_id'));
            })
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('name', 'like', "%$searchTerm%");
            })
            ->get()
            ->map(function (Village $village) {
                return [
                    'value' => $village->id,
                    'description' => $village->name,
                ];
            });
    }

    public function selectedOption($value)
    {
        $village = Village::find($value);

        return [
            'value' => optional($village)->id,
            'description' => optional($village)->name,
        ];
    }
    public function render()
    {
        $view = parent::render();
        $this->emit('villageLoaded');
        return $view;
    }
}