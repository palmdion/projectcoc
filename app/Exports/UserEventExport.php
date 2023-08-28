<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Event;
use App\Models\UserEvent;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class UserEventExport implements FromCollection
{

    // public function collection()
    // {

    //     return User::select('name', 'email')->get();
    // }
    protected $event;

    public function __construct($event)
    {
        $this->event = $event;
    }


    public function collection()
    {
       // Retrieve the user_events data
       $userEvents = UserEvent::where('event_id',$this->event->id);

       // Filter users based on user_events and events conditions
       $userIds = $userEvents->pluck('user_id')->toArray();
       $eventIds = $userEvents->pluck('event_id')->toArray();

       $users = User::whereIn('id', $userIds)
       ->whereIn('id', function ($query) use ($eventIds) {
        $query->select('user_id')
            ->from('user_events')
            ->whereIn('event_id', $eventIds);
         })
        ->select('name','last_name', 'email')
        ->get();

    return $users;
    }
}
