<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Users extends LivewireDatatable
{
    protected $listeners = ['refresh' => '$refresh'];
    public $model = User::class;
     /**
     * Write code on Method
     *
     * @return response()
     */
    public function columns()
    {
        return [
            Column::name('name')->label('Nama')->searchable(),
            Column::name('email')->label('E-mail')->searchable(),
            // Column::callback(['name', 'email'], function ($name,$email) {
            //     return view('table.user-name', ['name' => $name,'email' => $email]);
            // })->label('Nama'),

            Column::callback(['id','email_verified_at'], function ($id,$verified) {
                return view('table.user-verified', ['id' => $id,'verified'=>$verified]);
            })->label('Status'),

            Column::callback(['role'], function ($role) {
                return view('table.user-role', ['role' => $role]);
            })->label('Role')->filterable([
                ['id'=>'admin','name'=>'Admin'],
                ['id'=>'officer','name'=>'Petugas'],
                ['id'=>'user','name'=>'User Biasa']
            ]),

            Column::callback('created_at', function ($created) {
                return \Carbon\Carbon::parse($created)->isoFormat('HH:mm D MMMM Y');
            })->label('Tanggal'),

            Column::callback(['id'], function ($id) {
                return view('table.user-actions', ['id' => $id]);
            }),
        ];
    }
}
