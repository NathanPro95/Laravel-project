<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    //
    protected $table = 'schedules';

    protected $fillable = [
        'schedule_name',
        'contract_date',
        'valuable',
        'number_member',
        'construction_plan',
        'end_date',
        'schedule_status',
        'created_at',
        'updated_at'
    ];

    // public function getAll(){
    //     $data = $table::schedules->get();
    //     dd($data);
    // }

}
