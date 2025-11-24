<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeSalary extends Model
{
    use HasFactory;

    protected $table = 'employee_salary';
    protected $fillable = ['employee_id', 'basic_salary', 'allowance', 'deductions', 'effective_from'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
