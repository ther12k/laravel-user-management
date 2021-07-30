<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;
use App\Models\District;

class DistrictSelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
    {
        return District::query()
            ->when($this->hasDependency('regency_id'), function ($query) {
                $query->where('regency_id', $this->getDependingValue('regency_id'));
            })
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('name', 'like', "%$searchTerm%");
            })
            ->get()
            ->map(function (District $district) {
                return [
                    'value' => $district->id,
                    'description' => $district->name,
                ];
            });
    }

    public function selectedOption($value)
    {
        $district = District::find($value);

        return [
            'value' => optional($district)->id,
            'description' => optional($district)->name,
        ];
    }

    public function render()
    {
        $view = parent::render();
        $this->emit('districtLoaded');
        return $view;
    }
}