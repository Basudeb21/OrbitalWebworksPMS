<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\HR\EmployeeController;
use App\Http\Controllers\API\HR\DepartmentController;
use App\Http\Controllers\API\HR\RoleController;
use App\Http\Controllers\API\HR\LeaveTypeController;
use App\Http\Controllers\API\HR\LeaveRequestController;
use App\Http\Controllers\API\HR\EmployeeSalaryController;
use App\Http\Controllers\API\HR\EmployeePaymentHistoryController;
use App\Http\Controllers\API\HR\EmployeeCostController;


Route::prefix('hr')->group(function () {
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('departments', DepartmentController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('leave-types', LeaveTypeController::class);
    Route::apiResource('leave-requests', LeaveRequestController::class);
    Route::apiResource('salaries', EmployeeSalaryController::class);
    Route::apiResource('payments', EmployeePaymentHistoryController::class);
    Route::apiResource('costs', EmployeeCostController::class);
});