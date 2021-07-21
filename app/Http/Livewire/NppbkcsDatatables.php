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
                ->label('Nama')->searchable(),

            Column::callback(['status_nppbkc','no_permohonan_lokasi', 'no_permohonan'], function ($status,$no_permohonan_lokasi, $no_permohonan) {
                return ($status<3)
                    ? '<span class="text-gray-600">' . $no_permohonan . '</span>'
                    : '<span class="text-yellow-600">' . $no_permohonan . '</span>';
            })->label('No Permohonan')->searchable(),

            Column::callback(['status_nppbkc'], function ($status_nppbkc) {
                return view('table.nppbkc-status', ['status' => $status_nppbkc]);
            })->label('Status')->filterable([
                ['id'=>'1','name'=>'Aju Cek Lokasi'],
                ['id'=>'2','name'=>'Setuju Cek Lokasi'],
                ['id'=>'3','name'=>'Permohonan NPPBKC'],
                ['id'=>'4','name'=>'Ditolak'],
                ['id'=>'5','name'=>'Disetujui'],
            ]),
                
            Column::name('catatan_petugas')
                    ->label('Catatan Petugas')
                    ->truncate(30),

            Column::callback('created_at', function ($created) {
                return \Carbon\Carbon::parse($created)->isoFormat('HH:mm D MMMM Y');
            })->label('Tanggal'),

            Column::callback(['id', 'nama_pemilik'], function ($id, $name) {
                return view('table.nppbkc-actions', ['id' => $id, 'name' => '']);
            })
        ];
    }
}