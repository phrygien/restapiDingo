<?php

namespace App\Http\Controllers\Gestion;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class EmployeeController extends Controller
{
    public function activityLog()
    {
        $activities = Activity::all();
        return response()->json($activities);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employees = new Employee([
            'name' => $request->input('name'),
            'adress' => $request->input('adress'),
            'mobile' => $request->input('mobile'),
        ]);
        
        $employees->save();
        return response()->json([
            'messages' => 'Employee created',
            'data' => $employees
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json([
            'messages' => 'Details employee',
            'data' => $employee
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employees = Employee::findOrFail($id);
        $employees->update($request->all());
        return response()->json([
            'messages' => 'Employee updated',
            'data' => $employees
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return response()->json('Employee deleted');
    }

}
