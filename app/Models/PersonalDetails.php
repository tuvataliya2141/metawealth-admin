<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'dob',
        'gender',
        'retired',
        'marital_status',
        'joint_plan',
        'phone',
        'email',
        'address',
        'latitude',
        'longitude',
        'city',
        'province',
        'postal_code',
        'is_child',
        'child_tot',
        'child_age',
        'status',
    ];
}
