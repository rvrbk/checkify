<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Check;
use App\Models\Unit;
use App\Models\Employee;
use Illuminate\Support\Facades\Log;

class CheckController extends Controller
{
    public function check(Request $request)
    {
        $employee = Employee::where('uid', $request->employee)->first();
        $unit = Unit::where('uid', $request->unit)->first();

        if (!$employee) {
            Log::warning('Employee ' . $request->employee . ' not found');

            return ['success' => false];
        }

        if (!$unit) {
            Log::warning('Unit ' . $request->unit . ' not found');

            return ['success' => false];
        }

        $last = Check::last($employee, $unit);

        $check = new Check();

        $check->type = (!$last ? 'in' : ($last->type === 'out' ? 'in' : 'out'));
        $check->employee_id = $employee->id;
        $check->unit_id = $unit->id;

        if ($request->has('location')) {
            $check->location = $request->location;
        }

        $check->save();

        return ['status' => 'ok'];
    }
}
