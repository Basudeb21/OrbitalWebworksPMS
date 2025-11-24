<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password_hash',
        'gender',
        'dob',
        'department_id',
        'role_id',
        'join_date',
        'resign_date',
        'status'
    ];

    protected $hidden = ['password_hash'];


    // Relationships
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }

    public function salaries()
    {
        return $this->hasMany(EmployeeSalary::class);
    }

    public function paymentHistory()
    {
        return $this->hasMany(EmployeePaymentHistory::class);
    }

    public function costs()
    {
        return $this->hasMany(EmployeeCost::class);
    }

}
