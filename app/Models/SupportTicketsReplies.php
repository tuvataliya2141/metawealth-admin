<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicketsReplies extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'user_id',
        'subject',
        'details',
        'files',
    ];

    public function ticket(){
    	return $this->belongsTo(SupportTickets::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
