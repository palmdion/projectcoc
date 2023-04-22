<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;

use App\Models\Post;
use App\Models\Attachment;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Event;
use App\Models\User;
use App\Models\UserEvent;


class HomeController extends Controller
{
    public function showUser($id)
    {
        $user = User::find($id);
        return view('recognition.user',compact('user'));
    }
    public function showAllUser()
    {
        $users = User::where('role_id', '=', 3 )->orderBy('created_at', 'desc')->paginate(10);
        return view('recognition.users' ,compact('users'));
    }
    public function joinEventH(Request $request){
        $id = $request->eventId;
        $join = new UserEvent();
        $join->event_id = $id;
        $join->user_id = Auth::id();
        $join->save();

        return redirect()->route('eventHome.showEvent', $id)->with('success','Join Event successfully.');
    }

    public function showEvent($id)
    {
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
        $user = User::where('alumni',1);

        return view('event.event', ['event' => $event, 'btnStatus' => $btnStatus,'user' => $user,'userEvent'=>$userEvent]);
    }

    public function showAllEvent()
    {
        $events = Event::orderBy('created_at', 'desc')->paginate(10);
        return view('event.events' ,compact('events'));
    }
    public function eventAdd()
    {
        return view('event.eventAdd');
    }

    public function storeEvent(Request $request)
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

        return redirect()->route('eventHome.showAllEvent')->with('success', 'Event created successfully.');
        }   catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('eveeventHoment.eventAdd')->with('error',$th->getMessage());
        }
    }
    public function showAllPost()
    {
        $posts = Post::orderBy('created_at', 'asc')->paginate(10);
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.posts',['categories' => $categories ,'tags' => $tags,'posts' => $posts]);
    }

    public function showPost($id)
    {
        $posts = Post::find($id);
        $post = Post::orderBy('created_at', 'asc')->take(5)->get();
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.post',['categories' => $categories ,'tags' => $tags,'posts' => $posts,'post' => $post]);
    }
    public function postAdd()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.postAdd',['categories' => $categories ,'tags' => $tags,]);
    }

    public function storePost(Request $request)
    {
        //การเข้ารหัสรูปภาพ
        $image = $request->file('post_image');


        //Generate ชื่อภาพ
        $image_gen = hexdec(uniqid());

        //ดึงนามสกุลไฟล์ภาพ
        $image_ext = strtolower($image ->getClientOriginalExtension());
        $image_name = $image_gen. '.'.$image_ext;

        //อัพโหลดและบันทึกข้อมูล
        $image_location = 'posts/images/';
        $image_path = $image_location.$image_name;

        try {
            $post = new Post();
            $post->user_id = Auth::id();
            $post->post_title = $request->post_title;
            $post->post_image = $image_path;
            $post->description = $request->description;
            $post->save();

            //ซิงค์ category
            $categories = $request->input('categories');
            $post->category()->sync($categories);

            //ซิงค์ tag
            $tags = $request->input('tags');
            $post->tag()->sync($tags);

            $image -> move($image_location,$image_name);
            return redirect()->route('postHome.showAllPost')->with('success','Post created successfully.');
        }   catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('postHome.postAdd')->with('error',$th->getMessage());
        }
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexHome()
    {
        $posts = Post::orderBy('created_at', 'asc')->take(3)->get();
        $events = Event::orderBy('created_at', 'desc')->take(1)->get();
        $event = Event::orderBy('created_at', 'desc')->take(3)->get();
        //$user = User::orderBy('created_at', 'desc')->take(4)->get();
        $users = User::where('role_id', '=', 3 )->orderBy('created_at', 'desc')->take(4)->get();

        return view('home' ,compact('events','posts','users','event'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        try {
            DB::beginTransaction();

            #Update Password
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

            #Commit Transaction
            DB::commit();

            #Return To Profile page with success
            return back()->with('success', 'Password Changed Successfully.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function updateProfile()
    {
         //
    }
}
