<?php

namespace App\Services;

use App\Models\Employee;
use Symfony\Component\HttpFoundation\Response;

class EmployeeService
{
    public function storeCustom($request)
    {
        $request = $request->all();
        $request['created_by'] = 1;

        $employee = Employee::create($request);

        return response()->json([
            'data' => $employee,
            'message' => 'Successfully Saved!'
        ], Response::HTTP_OK);
    }
}
