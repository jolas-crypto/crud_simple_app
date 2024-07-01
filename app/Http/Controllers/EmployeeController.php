<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    private $serviceEmployee;

    public function __construct(EmployeeService $employeeService)
    {
        $this->serviceEmployee = $employeeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'employee' => Employee::all()
        ];

        return view('pages.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $storeEmployeeRequest)
    {
        $employee = $this->serviceEmployee->storeCustom($storeEmployeeRequest);

        return $employee;
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEmployeeRequest $storeEmployeeRequest, Employee $employee)
    {
        $employee->update($storeEmployeeRequest->all());

        return response()->json([
            'message' => 'Successfully Updated!'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json([
            'message' => 'Successfully Deleted!'
        ], Response::HTTP_OK);
    }
}
