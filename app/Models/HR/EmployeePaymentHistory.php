<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeePaymentHistory extends Model
{
    use HasFactory;

    protected $table = 'employee_payment_history';
    protected $fillable = ['employee_id', 'amount_paid', 'payment_month', 'payment_date', 'notes'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
