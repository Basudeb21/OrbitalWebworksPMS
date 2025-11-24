<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveType extends Model
{
    use HasFactory;

    protected $table = 'leave_types';
    protected $fillable = ['leave_name', 'max_days'];

    public function leaveRequests()
    {
        return $this->hasMany(LeaveRequest::class);
    }
}
