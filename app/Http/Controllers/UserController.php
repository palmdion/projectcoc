<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Education;
use App\Models\Department;
use App\Models\Degree;
use App\Models\Work;
use App\Models\Post;
use App\Models\Event;
use App\Models\Category;
use App\Models\Tag;
use App\Models\CategoryWork;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

use Carbon\Carbon;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Http\Controllers\EducationController;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create','store', 'updateStatus']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['delete']]);
    }

    /**
     * List User
     * @param Nill
     * @return Array $user
     * @author Shani Singh
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', ['users' => $users]);

    }

    /**
     * Create User
     * @param Nill
     * @return Array $user
     * @author Shani Singh
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.add', ['roles' => $roles]);
    }

    /**
     * Store User
     * @param Request $request
     * @return View Users
     * @author Shani Singh
     */
    public function store(Request $request)
    {
        // Validations
        $request->validate([
            'name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|unique:users,email',
            'mobile_number' => 'required|numeric|digits:10',
            'role_id'       =>  'required|exists:roles,id',
            'status'       =>  'required|numeric|in:1,2',
        ]);

        DB::beginTransaction();
        try {

            // Store Data
            $user = User::create([
                'name'    => $request->name,
                'last_name'     => $request->last_name,
                'email'         => $request->email,
                'mobile_number' => $request->mobile_number,
                'role_id'       => $request->role_id,
                'status'        => $request->status,
                'password'      => Hash::make($request->name.'@'.$request->mobile_number)
            ]);

            // Delete Any Existing Role
            DB::table('model_has_roles')->where('model_id',$user->id)->delete();

            // Assign Role To User
            $user->assignRole($user->role_id);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('users.index')->with('success','User Created Successfully.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Update Status Of User
     * @param Integer $status
     * @return List Page With Success
     * @author Shani Singh
     */
    public function updateStatus($user_id, $status)
    {
        // Validation
        $validate = Validator::make([
            'user_id'   => $user_id,
            'status'    => $status
        ], [
            'user_id'   =>  'required|exists:users,id',
            'status'    =>  'required|in:0,1',
        ]);

        // If Validations Fails
        if($validate->fails()){
            return redirect()->route('users.index')->with('error', $validate->errors()->first());
        }

        try {
            DB::beginTransaction();

            // Update Status
            User::whereId($user_id)->update(['status' => $status]);

            // Commit And Redirect on index with Success Message
            DB::commit();
            return redirect()->route('users.index')->with('success','User Status Updated Successfully!');
        } catch (\Throwable $th) {

            // Rollback & Return Error Message
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Edit User
     * @param Integer $user
     * @return Collection $user
     *
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit')->with([
            'roles' => $roles,
            'user'  => $user
        ]);
    }

    /**
     * Update User
     * @param Request $request, User $user
     * @return View Users
     * @author Shani Singh
     */
    public function update(Request $request, $id)
    {
          try {
                $user = User::find($id);
                $user->name = $request->name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $user->role_id = $request->role_id;
                $user->status = $request->status;

                // Delete Any Existing Role
                DB::table('model_has_roles')->where('model_id',$id)->delete();

                // Assign Role To User
                $user->assignRole($user->role_id);
                $user->save();

                return redirect()->route('users.index')->with('success','User update successfully.');
            }catch (\Throwable $th) {
                DB::rollback();
                return redirect()->back()->with('error',$th->getMessage());
            }
    }

    /**
     * Delete User
     * @param User $user
     * @return Index Users
     *
     */
    public function delete(User $user)
    {
        DB::beginTransaction();
        try {
            // Delete User
            User::whereId($user->id)->delete();

            DB::commit();
            return redirect()->route('users.index')->with('success', 'User Deleted Successfully!.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function importUsers()
    {
        return view('admin.users.import');
    }

    public function uploadUsers(Request $request)
    {
        try {
            Excel::import(new UsersImport, $request->file);

            return redirect()->route('users.index')->with('success', 'User Imported Successfully');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
        //Excel::import(new UsersImport, $request->file);

        //return redirect()->route('users.index')->with('success', 'User Imported Successfully');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

       /**
     * User Profile
     * @param Nill
     * @return View Profile
     * @author Shani Singh
     */
    public function getProfile()
    {
        $id = Auth::id();
        $education = Education::find($id);
        $department = Department::find($id);
        return view('profile.detail' ,compact('education','department'));
    }

    public function profileFace()
    {
        $user = Auth::user();
        $education = Education::where('user_id',$user->id)->get();
        $work = Work::where('user_id',$user->id)->get();
        return view('profile.profileFace',compact('education','work'));
    }

    public function manageProfile(User $user ,Education $id)
    {
        $edu = Education::find($id);
        $education = Education::all();
        $work = Work::with('cateWork')->get();
        $department = Department::all();
        $cateWork = CategoryWork::all();
        return view('profile.manageProfile' ,compact('user','education','department','cateWork','edu','work'));
    }
    public function myPosts()
    {
        $user = Auth::user();
        $posts = Post::where('user_id',$user->id)
                ->get();

        return view('profile.myPosts' ,compact('posts'));
    }

    public function editPost($id)
    {
        $post = Post::with('user')->find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('profile.editPost', ['post' => $post, 'categories' => $categories, 'tags' => $tags]);
    }


    public function updatePost(Request $request ,$id)
    {
        //การเข้ารหัสรูปภาพ
        $image = $request->file('post_image');

        if ( $image) {

          //Generate ชื่อภาพ
          $image_gen = hexdec(uniqid());


          //ดึงนามสกุลไฟล์ภาพ
          $image_ext = strtolower($image ->getClientOriginalExtension());
          $image_name = $image_gen. '.'.$image_ext;


          //อัพโหลดและอัพเดทข้อมูล
          $image_location = 'posts/images/';
          $image_path = $image_location.$image_name;


          //อัพเดทข้อมูล
          try {
                $post = Post::find($id);
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

                //ลบภาพเก่า
                $image_old = $request->image_old;
                unlink($image_old);

                $image -> move($image_location,$image_name);


                return redirect()->route('profile.myPosts')->with('success','Post update successfully.');
            }catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('profile.editPost')->with('error',$th->getMessage());
            }
        }
        else{
            //อัพเดทข้อมูล
         try {
           $post = Post::find($id);
           $post->user_id = Auth::id();
           $post->post_title = $request->post_title;
           $post->description = $request->description;
           $post->save();

           //ซิงค์ category
           $categories = $request->input('categories');
           $post->category()->sync($categories);

           //ซิงค์ tag
           $tags = $request->input('tags');
           $post->tag()->sync($tags);

           return redirect()->route('profile.myPosts')->with('success','Post update successfully.');
           }catch (\Throwable $th) {
               DB::rollback();
               return redirect()->route('profile.editPost')->with('error',$th->getMessage());
           }
        }
    }
    public function deletePost(Post $post, $id)
    {
        if ($post->id){
            $img = Post::find($id)->post_image;
            unlink($img);
            $post->category()->detach();
            $post->tag()->detach();
            $post->delete();
            $delete = Post::find($id)->delete();
        }
        else{
            $post->category()->detach();
            $post->tag()->detach();
            $post->delete();
            $delete = Post::find($id)->delete();
        }

        return redirect()->route('profile.myPosts')->with('success','Post deleted successfully.');
    }

    public function myEvent()
    {
        $user = Auth::user();
        $events = Event::where('user_id',$user->id)
                ->get();
        return view('profile.myEvent' ,compact('events'));
    }

    public function editEvent($id)
    {
        $event = Event::find($id);

        return view('profile.editEvent', compact('event'));
    }

    public function updateEvent(Request $request, $id)
    {
          //การเข้ารหัสรูปภาพ
          $image = $request->file('event_image');

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
                  $event->event_image = $image_path;
                  $event->description = $request->description;
                  $event->event_start = $request->event_start;
                  $event->event_end = $request->event_end;
                  $event->save();


                  //ลบภาพเก่า
                  $image_old = $request->image_old;
                  unlink($image_old);

                  $image -> move($image_location,$image_name);


                  return redirect()->route('profile.myEvent')->with('success','Event update successfully.');
              }catch (\Throwable $th) {
                  DB::rollback();
                  return redirect()->route('profile.editEvent')->with('error',$th->getMessage());
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


             return redirect()->route('profile.myEvent')->with('success','Event update successfully.');
             }catch (\Throwable $th) {
                 DB::rollback();
                 return redirect()->route('profile.editEvent')->with('error',$th->getMessage());
             }
          }
    }

    public function deleteEvent(Event $event,$id)
    {
        $img = Event::find($id)->event_image;
        unlink($img);
        $event->delete();
        $delete = Event::find($id)->delete();

        return redirect()->route('profile.myEvent')->with('success','Event deleted successfully.');
    }

    /**
     * Update Profile
     * @param $profileData
     * @return Boolean With Success Message
     * @author Shani Singh
     */
    public function updateProfile(Request $request)
    {

        //การเข้ารหัสรูปภาพ
        $image = $request->file('user_image');


        if($image){
            //Generate ชื่อภาพ
        $image_gen = hexdec(uniqid());

        //ดึงนามสกุลไฟล์ภาพ
        $image_ext = strtolower($image ->getClientOriginalExtension());
        $image_name = $image_gen. '.'.$image_ext;

        //อัพโหลดและบันทึกข้อมูล
        $image_location = 'users/images/';
        $image_path = $image_location.$image_name;

        try {
            $user = User::find(auth()->user()->id);
            $user->title_name = $request->title_name;
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->user_image = $image_path;
            $user->mobile_number = $request->mobile_number;
            $user->birthdate = $request->birthdate;
            $user->gender = $request->gender;
            $user->blood_type = $request->blood_type;
            $user->user_bio = $request->user_bio;
            $user->user_linkedin = $request->user_linkedin;
            $user->user_facebook = $request->user_facebook;
            $user->email_backup = $request->email_backup;

            $user->save();


            //ลบภาพเก่า
            //$image_old = $request->image_old;
            //unlink($image_old);

            $image -> move($image_location,$image_name);

            return redirect()->route('profile.profileFace')->with('success','Post update successfully.');
        }   catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('profile.profileFace')->with('error',$th->getMessage());
        }
        }else{
            try {
                $user = User::find(auth()->user()->id);
                $user->title_name = $request->title_name;
                $user->name = $request->name;
                $user->last_name = $request->last_name;
                $user->mobile_number = $request->mobile_number;
                $user->birthdate = $request->birthdate;
                $user->gender = $request->gender;
                $user->blood_type = $request->blood_type;
                $user->user_bio = $request->user_bio;
                $user->user_linkedin = $request->user_linkedin;
                $user->user_facebook = $request->user_facebook;
                $user->email_backup = $request->email_backup;
                $user->save();

                return redirect()->route('profile.profileFace')->with('success','Post update successfully.');
            }   catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('profile.profileFace')->with('error',$th->getMessage());
            }
        }
    }

    /**
     * Change Password
     * @param Old Password, New Password, Confirm New Password
     * @return Boolean With Success Message
     * @author Shani Singh
     */
}
