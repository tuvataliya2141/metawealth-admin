<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetWorthRankings extends Model
{
    use HasFactory;
    protected $fillable = [
        'net_worth_percentile',
        'net_worth',
    ];
}
