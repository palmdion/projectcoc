<?php

namespace App\Exports;

use App\Models\User;
use App\Models\UserEvent;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return User::select('name', 'email')->get();
    }

    // public function collection()
    // {
    //     return DB::table('user_events')
    //     ->join('users','user_events.user_id','=','users.id')
    //     ->where('user_events.user_id','users.id')
    //     ->select('users.name','users.email');
    // }
}
