<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Http\Resources\V1\EmployeeResource;
use App\Http\Resources\V1\EmployeeCollection;
use Illuminate\Http\Request;

class EmployeeController extends Controller {

    public function index() {
        return new EmployeeCollection(Employee::paginate());
    }

    public function store(Request $request) {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'salary' => 'required'
        ]);

        $data = [
            'fname' => $request->all()['fname'],
            'lname' => $request->all()['lname'],
            'email' => $request->all()['email'],
            'phonenumber' => $request->all()['phonenumber'],
            'salary' => $request->all()['salary']
        ];
        return new EmployeeResource(Employee::create($data));
    }

    public function show(string $id) {
        return new EmployeeResource(Employee::find($id));
    }

    public function showByEmail(string $email) {
        return new EmployeeResource(Employee::where('email', $email)->get());
    }

    public function update(Request $request, string $id) {
        $employee = Employee::find($id);
        $employee->update($request->all());
        return new EmployeeResource($employee);
    }


    public function destroy(string $id) {
        return Employee::destroy($id);
    }


    public function search(Request $request, string $text) {
        $limit = $request->query('limit');
        $offset = $request->query('offset');

        return Employee::where('fname', 'like', '%'.$text.'%')
                        ->orWhere('lname', 'like', '%'.$text.'%')
                        ->orWhere('email', 'like', '%'.$text.'%')
                        ->orWhere('phonenumber', 'like', '%'.$text.'%')
                        ->offset(intval($offset))
                        ->limit(intval($limit))
                        ->get();
    }
}

