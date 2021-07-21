<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ActivityLog extends LivewireDatatable
{
    protected $listeners = ['refresh' => '$refresh'];
    public $model = \App\Models\ActivityLog::class;
    public function builder()
    {
        return \App\Models\ActivityLog::query()
            // ->leftJoin('nppbkcs', 'nppbkcs.id', 'activity_log.subject_id')
            ->leftJoin('nppbkcs', function($join) 
            {
                $join->on('activity_log.subject_id', '=', 'nppbkcs.id');
                $join->where('subject_type','App\Models\Nppbkc');
        
            })
            // ->leftJoin('users', function($join) 
            // {
            //     $join->on('activity_log.subject_id', '=', 'users.id');
            //     $join->where('subject_type','App\Models\User');
        
            // })
            ->leftJoin('users', 'users.id', 'activity_log.causer_id')
            ->orderByDesc('activity_log.created_at');
    }
     /**
     * Write code on Method
     *
     * @return response()
     */
    public function columns()
    {
        //include="user.name|User,log_name,description,created_at,updated_at,properties"
        return [
            Column::name('users.name')->label('Nama user')->searchable(),
            Column::name('log_name')->label('Log')->searchable(),
            Column::name('description')->label('Deskripsi')->searchable(),

            Column::callback('created_at', function ($created) {
                return \Carbon\Carbon::parse($created)->isoFormat('HH:mm D MMMM Y');
            })->label('Tanggal'),

            Column::name('nppbkcs.no_permohonan')->label('Keterangan')->searchable(),

            Column::callback(['nppbkcs.id'], function ($id) {
                return view('table.activity-log-actions', ['id' => $id]);
            }),

            // Column::callback(['role'], function ($role) {
            //     return view('table.user-role', ['role' => $role]);
            // })->label('Role')->filterable([
            //     ['id'=>'admin','name'=>'Admin'],
            //     ['id'=>'officer','name'=>'Petugas'],
            //     ['id'=>'user','name'=>'User Biasa']
            // ]),
            // Column::callback(['id'], function ($id) {
            //     return view('table.user-actions', ['id' => $id]);
            // }),
        ];
    }
}
