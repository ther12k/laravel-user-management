<?php
  
namespace App\Http\Livewire;
   
use Livewire\Component;
use App\Models\Nppbkc;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
  
class NppbkcsDatatables extends LivewireDatatable
{
    public $model = Nppbkc::class;
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->sortBy('id'),
  
            Column::name('nama_pemilik')
                ->label('Nama')
                ->sortBy('nama_pemilik'),
            
            Column::name('lokasi')
                    ->label('Lokasi')
                    ->sortBy('lokasi'),

            Column::name('status_nppbkc')
                ->label('Status')
                ->sortBy('status_nppbkc'),

            DateColumn::name('created_at')
                ->label('Tanggal'),

            Column::callback(['id', 'nama_pemilik'], function ($id, $name) {
                return view('table.nppbkc-actions', ['id' => $id, 'name' => '']);
            })
        ];
    }
}