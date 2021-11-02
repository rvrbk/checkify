<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;

    public static function last(Employee $employee, Unit $unit)
    {
        return self::where('checks.employee_id', $employee->id)
            ->where('checks.unit_id', $unit->id)
            ->orderBy('checks.created_at', 'desc')
            ->first();
    }
}
