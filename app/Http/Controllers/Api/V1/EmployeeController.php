<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Http\Resources\V1\EmployeeResource;
use App\Http\Resources\V1\EmployeeCollection;
use App\Filters\V1\EmployeeFilter;
use App\Http\Requests\V1\StoreEmployeeRequest;
use App\Http\Requests\V1\UpdateEmployeeRequest;

class EmployeeController extends Controller {

    public function index(Request $request) {
        $filter = new EmployeeFilter();
        $queryItems = $filter->transform($request);
        if(count($queryItems) == 0) {
            return new EmployeeCollection(Employee::paginate());
        } else {
            $employees = Employee::where($queryItems)->paginate();
            return $employees->appends($request->query());
            //return new EmployeeCollection($employees->appends($request->query()));
        }
    }

    public function store(StoreEmployeeRequest $request) {
        return new EmployeeResource(Employee::create($request->all()));
    }

    public function show(string $id) {
        return new EmployeeResource(Employee::find($id));
    }

    public function showByEmail(string $email) {
        return new EmployeeResource(Employee::where('email', $email)->get());
    }

    public function update(UpdateEmployeeRequest $request, string $id) {
        $employee = Employee::find($id);
        $employee->update($request->all());
        return new EmployeeResource($employee);
    }


    public function destroy(string $id) {
        return Employee::destroy($id);
    }
}

