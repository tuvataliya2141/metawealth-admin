<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WealthManagement extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'event_name',
        'event_budget',
        'event_year',
        'income_name',
        'income_budget',
        'income_year',
        'total_wealth',
        'age',
        'rate_return',
        'event_start_year',
        'event_end_year',
        'devide_year',
        'down_payment',
        'interest',
    ];
}
