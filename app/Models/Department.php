<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'degree_shortName',
        'degree_fullName',
        'depart_fullName',
        'depart_shortName',
        'degreeName_full',
        'degreeName_short',

    ];
    
    public function education()
    {
        return $this->hasMany(Education::class);
    }
}
