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

use App\Models\UserAlumni;
use App\Models\Alumni;
use App\Models\User;
use App\Models\Post;
use App\Models\Attachment;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Event;
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

        //$user = User::find(Auth::id())->get();

        //if($user->alumni == 0 && $user->event == 0){
           // return redirect()->route('eventHome.showEvent', $id)->with('error','Can not join event please contact Admin.');
        //}


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
        $userEventStatus = UserEvent::where('event_id', $id)->where('user_id',Auth::id())->where('status','=',1)->get();
        $check = UserEvent::where('event_id', $id)->where('user_id',Auth::id())->get();
        $btnStatus = 0;
        $aluniStatus = User::find(Auth::id());
        if(count($check) == 0){
            $btnStatus = 1;
        }
        elseif(count($check) != 0 && $aluniStatus->alumni == 0 && count($userEventStatus) == 0){
            $btnStatus = 4;
        }
        else{
            $btnStatus = 2;
        }
        if(Carbon::parse($event->event_end)->addDays(1) < Carbon::now()){
            $btnStatus = 3;
        }
        $user = User::where('alumni',1);

        return view('event.event', ['event' => $event, 'btnStatus' => $btnStatus,'user' => $user,'userEvent'=>$userEvent]);
    }

    // public function test(Request $request ,$status) {
    //     $userStatus = UserEvent::where('event_id', $id)->where('status',$status)->get();
    //     return view('admin.event.show', ['userStatus' => $userStatus]);

    // }

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
            return redirect()->route('eventHome.eventAdd')->with('error',$th->getMessage());
        }
    }

    public function showAllPost()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all();

        return view('post.posts',['categories' => $categories ,'posts' => $posts]);
    }

    public function showPost($id)
    {
        $posts = Post::find($id);
        $post = Post::orderBy('created_at', 'desc')->take(5)->get();
        $categories = Category::all();
        // $tags = Tag::all();
        return view('post.post',['categories' => $categories ,'posts' => $posts,'post' => $post]);
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
        $posts = Post::orderBy('created_at', 'desc')->take(3)->get();
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

    public function indexRequest()
    {
        return view('sendRequest');

    }
    // public function indexSearch(Request $request)
    // {
    //     $keyword = $request->input('keyword');
    //     $alumnis = Alumni::search($keyword)->get();

    //     // $search_text = $_GET['queryAlumni'];
    //     // $alumnis = Alumni::where('student_code','student_name_th', '%'. $search_text.'%')->get();
    //      return view('search.indexSearch',compact('alumnis'));
    // }

    public function indexSearch(Request $request)
    {
        $user = User::all();
        $keyword = $request->input('keyword');
        // $keyword_D =  $request->input('keyword_degree');
        // $keyword_Edu =  $request->input('keyword_edu');
        // $caWork = CategoryWork::all();

        $searchResult = UserAlumni::join('users','user_alumnis.user_id','=','users.id')
                        ->leftJoin('alumnis','user_alumnis.alumni_id','=','alumnis.id')
                        ->where('student_code', 'like', "%$keyword%")
                        ->orWhere('student_name_th', 'like', "%$keyword%")
                        ->orWhere('student_surname_th', 'like', "%$keyword%")
                        ->orWhere('program_name', 'like', "%$keyword%")
                        ->orWhere('faculty_name', 'like', "%$keyword%")
                        ->orWhere('admit_year', 'like', "%$keyword%")
                        ->get();

        return view('search.indexSearch', ['searchResult' => $searchResult,'user' => $user]);

        // $keyword = $request->input('keyword');
        // $authorName = $request->input('author_name');
        // $alumnis = Alumni::where('student_code', 'like', "%$keyword%")
        //              ->whereHas('user', function ($query) use ($authorName) {
        //                  $query->where('name', 'like', "%$authorName%");
        //              })
        //              ->get();
        // return view('search.indexSearch', ['alumnis' => $alumnis]);
    }


}
