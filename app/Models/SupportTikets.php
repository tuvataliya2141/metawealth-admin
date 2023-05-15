<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTikets extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'user_id',
        'subject',
        'details',
        'files',
        'status',
        'viewed',
    ];

    public function ticketreplies()
    {
        return $this->hasMany(SupportTiketsReplies::class)->orderBy('created_at', 'desc');
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
