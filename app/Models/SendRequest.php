<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendRequest extends Model
{
    use HasFactory;
    protected $table = 'send_request';
    protected $fillable = [
        'user_id',
        'mail_address',
        'mobile_number',
        'subject',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
