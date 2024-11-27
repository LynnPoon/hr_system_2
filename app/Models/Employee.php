<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    public function department () : BelongsTo{
      return $this->belongsTo(Department::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
      'first_name',
      'last_name',
      'position',
      'department_id',
      'date_of_employment',
      'salary',
      'phone_num',
      'user_id', // Include this if you plan to link employees to users
  ];
}
