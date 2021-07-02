<?php
  
namespace App\Http\Livewire;
   
use Livewire\Component;
use App\Models\Nppbkc;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

use Illuminate\Support\Facades\Auth;
  
class NppbkcsDatatables extends LivewireDatatable
{
    public $model = Nppbkc::class;

    public function builder()
    {
        $user = Auth::user();
        if(\Gate::allows('viewAllNppbkc')){
            return Nppbkc::query();
        }else{
            return Nppbkc::query()->where('created_by','=',Auth::user()->id);
        }
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function columns()
    {
        return [
            Column::name('nama_pemilik')
                ->label('Nama'),
            
            NumberColumn::name('no_permohonan')
                ->label('No Permohonan')
                ->sortBy('no_permohonan'),

            Column::name('status_nppbkc')
                ->label('Status')
                ->sortBy('status_nppbkc'),
                
            Column::name('alamat_pemilik')
                    ->label('Catatan Petugas')
                    ->sortBy('status_nppbkc'),

            DateColumn::name('created_at')
                ->label('Tanggal'),

            Column::callback(['id', 'nama_pemilik'], function ($id, $name) {
                return view('table.nppbkc-actions', ['id' => $id, 'name' => '']);
            })
        ];
    }
}