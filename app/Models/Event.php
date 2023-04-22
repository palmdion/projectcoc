<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'event_title',
        'description',
        'event_image_cover',
        'event_start',
        'event_end',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function participant()
    {
        return $this->hasMany(Participant::class);
    }
    public function attachments(){
        return $this->hasMany(Attachment::class);
    }
}
