<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeCost extends Model
{
    use HasFactory;

    protected $table = 'employee_costs';
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
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
