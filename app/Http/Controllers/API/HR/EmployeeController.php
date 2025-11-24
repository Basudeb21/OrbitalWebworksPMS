<?php

namespace App\Http\Controllers\API\HR;

use App\Http\Controllers\Controller;
use App\Models\HR\Employee;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Helpers\HttpStatus;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        try {
            $employees = Employee::with(['department', 'role'])->get();
            return ApiResponse::success($employees, 'Employees fetched successfully', HttpStatus::OK);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to fetch employees', [$e->getMessage()], HttpStatus::INTERNAL_SERVER_ERROR);
        }
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
            'join_date' => 'required|date',
        ]);

        try {
            $employee = Employee::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password_hash' => Hash::make($validated['password']),
                'gender' => $validated['gender'],
                'dob' => $validated['dob'],
                'department_id' => $validated['department_id'],
                'role_id' => $validated['role_id'],
                'join_date' => $validated['join_date'],
                'status' => 'active',
            ]);

            return ApiResponse::success($employee, 'Employee created successfully', HttpStatus::CREATED);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to create employee', [$e->getMessage()], HttpStatus::INTERNAL_SERVER_ERROR);
        }
    }
    public function show($id)
    {
        try {
            $employee = Employee::with(['department', 'role'])->findOrFail($id);
            return ApiResponse::success($employee, 'Employee fetched successfully', HttpStatus::OK);
        } catch (\Exception $e) {
            return ApiResponse::error('Employee not found', [$e->getMessage()], HttpStatus::NOT_FOUND);
        }
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return ApiResponse::error('Employee not found', [], HttpStatus::NOT_FOUND);
        }

        $validated = $request->validate([
            'first_name' => 'sometimes|required|string|max:100',
            'last_name' => 'sometimes|required|string|max:100',
            'email' => "sometimes|required|email|unique:employees,email,$id",
            'phone' => 'sometimes|required|string|max:20',
            'password' => 'sometimes|nullable|string|min:8',
            'gender' => 'sometimes|required|in:male,female,other',
            'dob' => 'sometimes|required|date',
            'department_id' => 'sometimes|required|exists:departments,id',
            'role_id' => 'sometimes|required|exists:roles,id',
            'join_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:active,inactive',
        ]);

        try {
            if (isset($validated['password'])) {
                $validated['password_hash'] = Hash::make($validated['password']);
                unset($validated['password']);
            }

            $employee->update($validated);

            return ApiResponse::success($employee, 'Employee updated successfully', HttpStatus::OK);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to update employee', [$e->getMessage()], HttpStatus::INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return ApiResponse::error('Employee not found', [], HttpStatus::NOT_FOUND);
        }

        try {
            $employee->delete();
            return ApiResponse::success(null, 'Employee deleted successfully', HttpStatus::NO_CONTENT);
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to delete employee', [$e->getMessage()], HttpStatus::INTERNAL_SERVER_ERROR);
        }
    }
}