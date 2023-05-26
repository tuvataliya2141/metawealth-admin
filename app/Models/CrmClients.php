<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmClients extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'gender',
        'nationality',
        'occupation',
        'industry',
        'employer',
        'id_type',
        'id_number',
        'id_place',
        'phone_number',
        'cell_phone',
        'fax',
        'email',
        'address',
        'receiving_funds',
        'sending_funds',
        'expected_transaction',
        'annual_income',
        'source_funds',
        'trading_purpose',
        'date_of_contact',
        'mode_of_contact',
        'notes_from_contact',
        'followup_date',
        'status',
        'followup_notification',
        'followup_notification_email',
        'clients'
    ];
}
