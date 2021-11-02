<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Password;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::all();

        return view('employees.index', [
            'employees' => $employees
        ]);
    }

    public function add(Request $request)
    {
        return view('employees.form');
    }
    
    public function edit(Request $request, Employee $employee)
    {
        return view('employees.form', [
            'employee' => $employee
        ]);
    }

    public function put(Request $request)
    {   
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = uniqid();

        $user->save();

        $status = Password::sendResetLink($request->only('email'));

        $employee = new Employee();

        $employee->uid = uniqid();
        $employee->user_id = $user->id;

        $employee->save();

        return redirect()->route('employees.index');
    }

    public function patch(Request $request, Employee $employee)
    {
        $employee->user->name = $request->name;
        $employee->user->email = $request->email;
     
        $employee->user->save();

        return redirect()->route('employees.index');
    }
}
