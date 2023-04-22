<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'cateWork_id',
        'work_name',
        'description',
        'company_name',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cateWork()
    {
        return $this->belongsTo(CategoryWork::class);
    }
}
