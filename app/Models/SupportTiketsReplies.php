<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTiketsReplies extends Model
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
    	return $this->belongsTo(SupportTikets::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
