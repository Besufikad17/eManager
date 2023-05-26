<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Employee::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'password' => 'required',
            'salary' => 'required'
        ]);

        $data = [
            'fname' => $request->all()['fname'],
            'lname' => $request->all()['lname'],
            'email' => $request->all()['email'],
            'phonenumber' => $request->all()['phonenumber'],
            'password' => password_hash($request->all()['fname'].$request->all()['lname'], PASSWORD_DEFAULT),
            'salary' => $request->all()['salary']
        ];
        return Employee::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Employee::find($id);
    }

    public function showByEmail(string $email)
    {
        return Employee::where('email', $email)->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);
        $employee->update($request->all());
        return $employee;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Employee::destroy($id);
    }

    /**
     * Searches for employee with given text
     */
    public function search(Request $request, string $text)
    {
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

