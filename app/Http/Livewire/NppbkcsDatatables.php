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

            Column::callback(['no_permohonan_lokasi', 'no_permohonan'], function ($no_permohonan_lokasi, $no_permohonan) {
                return empty($no_permohonan)
                    ? '<span class="text-gray-600">' . $no_permohonan_lokasi . '</span>'
                    : '<span class="text-yellow-600">' . $no_permohonan . '</span>';
            }),

            Column::callback(['status_nppbkc'], function ($status_nppbkc) {
                return view('table.nppbkc-status', ['status' => $status_nppbkc]);
            })->label('Status'),
                
            Column::name('catatan_petugas')
                    ->label('Catatan Petugas')
                    ->truncate(30),

            // Column::callback(['annotations.catatan_petugas'], function ($catatan) {
            //     return view('table.nppbkc-catatan', ['catatan' => $catatan]);
            // })->label('Catatan Petugas'),

            DateColumn::name('created_at')
                ->label('Tanggal'),

            Column::callback(['id', 'nama_pemilik'], function ($id, $name) {
                return view('table.nppbkc-actions', ['id' => $id, 'name' => '']);
            })
        ];
    }
}