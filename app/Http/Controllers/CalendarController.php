<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\Post;
use App\Models\Post_tag;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\Participant;
use App\Models\Attachment;
use App\Models\UserEvent;


class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $events = Event::with('user')->paginate(10);

        return view('admin.event.index', compact('events'));
    }

    public function create()
    {

        return view('admin.event.create');
    }

    public function storeE(Request $request)
    {
        //การเข้ารหัสรูปภาพ
        $image = $request->file('event_image');

        //Generate ชื่อภาพ
        $image_gen = hexdec(uniqid());

        //ดึงนามสกุลไฟล์ภาพ
        $image_ext = strtolower($image ->getClientOriginalExtension());
        $image_name = $image_gen. '.'.$image_ext;

        //อัพโหลดและบันทึกข้อมูล
        $image_location = 'events/images/';
        $image_path = $image_location.$image_name;


        try {
            $event = new Event();
            $event->user_id = Auth::id();
            $event->event_title = $request->event_title;
            $event->description = $request->description;
            $event->event_image_cover = $image_path;
            $event->event_start = $request->event_start;
            $event->event_end = $request->event_end;
            $event->save();

            $image -> move($image_location,$image_name);

            if($request->hasFile('event_image_multiple')){
                $files = $request->file('event_image_multiple');
                foreach ($files as $file) {
                    $image_gen = hexdec(uniqid());

                    //ดึงนามสกุลไฟล์ภาพ
                    $image_ext = strtolower($file ->getClientOriginalExtension());
                    $image_name = $image_gen. '.'.$image_ext;

                    //อัพโหลดและบันทึกข้อมูล
                    $image_location = 'events/gallery/';
                    $image_path = $image_location.$image_name;

                    $file->move($image_location,$image_name);

                    $attach = new Attachment();
                    $attach->event_id = $event->id;
                    $attach->path = $image_path;
                    $attach->save();
                }
            }

            return redirect()->route('event.index')->with('success', 'Event created successfully.');
        }   catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('event.index')->with('error',$th->getMessage());
        }
    }

    public function storeEvent(Request $request)
    {
        //การเข้ารหัสรูปภาพ
        $image = $request->file('event_image_cover');
        dd($image);
        //Generate ชื่อภาพ
        $image_gen = hexdec(uniqid());

        //ดึงนามสกุลไฟล์ภาพ
        $image_ext = strtolower($image ->getClientOriginalExtension());
        $image_name = $image_gen. '.'.$image_ext;

        //อัพโหลดและบันทึกข้อมูล
        $image_location = 'events/images/';
        $image_path = $image_location.$image_name;


        try {
            $event = new Event();
            $event->user_id = Auth::id();
            $event->event_title = $request->event_title;
            $event->description = $request->description;
            $event->event_image_cover = $image_path;
            $event->event_start = $request->event_start;
            $event->event_end = $request->event_end;
            $event->save();

            $image -> move($image_location,$image_name);

            return redirect()->route('event.index')->with('success', 'Event created successfully.');
        }   catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('event.index')->with('error',$th->getMessage());
        }
    }

    public function edit($id)
    {
        $event = Event::find($id);

        return view('admin.event.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
          //การเข้ารหัสรูปภาพ
          $image = $request->file('event_image');
          $wait = $id;

          if($request->hasFile('event_image_multiple')){
            $files = $request->file('event_image_multiple');
            foreach ($files as $file) {
                $image_gen = hexdec(uniqid());

                //ดึงนามสกุลไฟล์ภาพ
                $image_ext = strtolower($file ->getClientOriginalExtension());
                $image_name = $image_gen. '.'.$image_ext;

                //อัพโหลดและบันทึกข้อมูล
                $image_location = 'events/gallery/';
                $image_path = $image_location.$image_name;

                $file->move($image_location,$image_name);

                $attach = new Attachment();
                $attach->event_id = $wait;
                $attach->path = $image_path;
                $attach->save();
            }
        }

            if(!empty($request->list_delete)){
                $data = explode(',', $request->list_delete);
                foreach($data as $key){
                    $att = Attachment::find($key);
                    if($att){
                        $att->delete();
                    }
                }
            }

          if ( $image) {

            //Generate ชื่อภาพ
            $image_gen = hexdec(uniqid());


            //ดึงนามสกุลไฟล์ภาพ
            $image_ext = strtolower($image ->getClientOriginalExtension());
            $image_name = $image_gen. '.'.$image_ext;


            //อัพโหลดและอัพเดทข้อมูล
            $image_location = 'events/images/';
            $image_path = $image_location.$image_name;

            //อัพเดทข้อมูล
            try {
                  $event = Event::find($id);
                  $event->user_id = Auth::id();
                  $event->event_title = $request->event_title;
                  $event->event_image_cover = $image_path;
                  $event->description = $request->description;
                  $event->event_start = $request->event_start;
                  $event->event_end = $request->event_end;
                  $event->save();


                  //ลบภาพเก่า
                  $image_old = $request->image_old;
                  unlink($image_old);

                  $image -> move($image_location,$image_name);


                  return redirect()->route('event.index')->with('success','Event update successfully.');
              }catch (\Throwable $th) {
                  DB::rollback();
                  return redirect()->route('event.edit',$id)->with('error',$th->getMessage());
              }
          }
          else{
              //อัพเดทข้อมูล
           try {
            $event = Event::find($id);
            $event->user_id = Auth::id();
            $event->event_title = $request->event_title;
            $event->description = $request->description;
            $event->event_start = $request->event_start;
            $event->event_end = $request->event_end;
            $event->save();


             return redirect()->route('event.index')->with('success','Event update successfully.');
             }catch (\Throwable $th) {
                 DB::rollback();
                 return redirect()->route('event.edit', $id)->with('error',$th->getMessage());
             }
          }
    }

    public function delete(Event $event,$id)
    {
        $img = Event::find($id)->event_image_cover;
        unlink($img);
        $event->delete();
        $eventsFind = Event::find($id);
        if($eventsFind){
            foreach($eventsFind->attachments as $att){
                $att->delete();
            }
            $eventsFind->delete();
        }


        return redirect()->route('event.index')->with('success','Event deleted successfully.');
    }


    public function joinEvent(Request $request){
        $id = $request->eventId;
        $join = new UserEvent();
        $join->event_id = $id;
        $join->user_id = Auth::id();
        $join->save();


        return redirect()->route('event.show', $id)->with('success','Join Event successfully.');
    }

    public function joinEventH(Request $request){
        $id = $request->eventId;
        $join = new UserEvent();
        $join->event_id = $id;
        $join->user_id = Auth::id();
        $join->save();


        return redirect()->route('eventHome.showEvent', $id)->with('success','Join Event successfully.');
    }

    public function show($id)
    {
        $user = User::all();
        $event = Event::find($id);
        $userEvent = UserEvent::where('event_id', $id)->get();
        $check = UserEvent::where('event_id', $id)->where('user_id',Auth::id())->get();
        $btnStatus = 0;
        if(count($check) == 0){
            $btnStatus = 1;
        }else{
            $btnStatus = 2;
        }

        if(Carbon::parse($event->event_end)->addDays(1) < Carbon::now()){
            $btnStatus = 3;
        }

        return view('admin.event.show', ['event' => $event, 'btnStatus' => $btnStatus , 'user' => $user,'userEvent' => $userEvent]);
    }
}
