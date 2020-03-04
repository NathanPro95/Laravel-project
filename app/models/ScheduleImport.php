<?php

namespace App\models;

use App\models\schedule;
use \Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;

class ScheduleImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new schedule([
            'schedule_name'     => $row[1],
            'contract_date'     => !empty($row[2]) ? date('Y-m-d',strtotime($row[2])) : null,
            'valuable'          => $row[3] != null ? (int)$row[3] : null,
            'number_member'     => $row[4] != null ? (int)$row[4] : null,
            'construction_plan' => $row[5],
            'schedule_status'   => $row[6],
            'end_date'          => !empty($row[7]) ? date('Y-m-d',strtotime($row[7])) : null,
        ]);
    }
}
