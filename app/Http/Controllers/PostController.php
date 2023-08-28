<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use App\Models\Post;
use App\Models\Post_tag;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;



class PostController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     **/
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexPost()
    {
        $posts = Post::with('user')->paginate(10);
        return view('admin.posts.indexPost' ,compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        // $tags = Tag::all();
        return view('admin.posts.create',['categories' => $categories ]);
    }

    public function store(Request $request)
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
            // $post->is_approved = $request->is_approved;
            // $post->status = $request->status;
            $post->save();

            //ซิงค์ category

            $categories = $request->input('categories');
            $post->category()->sync($categories);

            // //ซิงค์ tag
            // $tags = $request->input('tags');
            // $post->tag()->sync($tags);

            $image -> move($image_location,$image_name);
            return redirect()->route('posts.indexPost')->with('success','Post created successfully.');
        }   catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('posts.indexPost')->with('error',$th->getMessage());
        }
    }

     /**
     * Update Status Of Post
     * @param Integer $status
     * @return List Page With Success
     *
     */
    /*public function updateStatus($user_id, $status)
    {
        // Validation
        $validate = Validator::make([
            'post_id'   => $post_id,
            'approval'  => $approval,
            'status'    => $status
        ], [
            'post_id'   =>  'required|exists:posts,id',
            'approval'  =>  'required|in:0,1',
            'status'    =>  'required|in:0,1,2',
        ]);

        // If Validations Fails
        if($validate->fails()){
            return redirect()->route('posts.index')->with('error', $validate->errors()->first());
        }

        try {
            DB::beginTransaction();

            // Update Status
            Post::whereId($post_id)->update(['approval' => $approval,'status' => $status]);

            // Commit And Redirect on index with Success Message
            DB::commit();
            return redirect()->route('posts.index')->with('success','Post Status Updated Successfully!');
        } catch (\Throwable $th) {

            // Rollback & Return Error Message
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }*/
      /**
     * Edit Post
     */
    public function edit($id)
    {
        $post = Post::with('user')->find($id);
        $categories = Category::all();
        // $tags = Tag::all();
        return view('admin.posts.edit', ['post' => $post, 'categories' => $categories]);
    }


    public function update(Request $request ,$id)
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
                // $post->is_approved = $request->is_approved;
                // $post->status = $request->status;
                $post->save();

                //ซิงค์ category
                $categories = $request->input('categories');
                $post->category()->sync($categories);

                // //ซิงค์ tag
                // $tags = $request->input('tags');
                // $post->tag()->sync($tags);

                //ลบภาพเก่า
                $image_old = $request->image_old;
                unlink($image_old);

                $image -> move($image_location,$image_name);


                return redirect()->route('posts.indexPost')->with('success','Post update successfully.');
            }catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('posts.indexPost')->with('error',$th->getMessage());
            }
        }
        else{
            //อัพเดทข้อมูล
         try {
           $post = Post::find($id);
           $post->user_id = Auth::id();
           $post->post_title = $request->post_title;
           $post->description = $request->description;
        //    $post->is_approved = $request->is_approved;
        //    $post->status = $request->status;
           $post->save();

           //ซิงค์ category
           $categories = $request->input('categories');
           $post->category()->sync($categories);

        //    //ซิงค์ tag
        //    $tags = $request->input('tags');
        //    $post->tag()->sync($tags);

           return redirect()->route('posts.indexPost')->with('success','Post update successfully.');
           }catch (\Throwable $th) {
               DB::rollback();
               return redirect()->route('posts.indexPost')->with('error',$th->getMessage());
           }
        }
    }


    public function show($id)
    {
        $posts = Post::find($id);
        $categories = Category::all();
        // $tags = Tag::all();
        return view('admin.posts.show',['categories' => $categories,'posts' => $posts]);
    }

    public function delete(Post $post, $id)
    {
        if ($post->id){
            $img = Post::find($id)->post_image;
            unlink($img);
            $post->category()->detach();
            // $post->tag()->detach();
            $post->delete();
            $delete = Post::find($id)->delete();
        }
        else{
            $post->category()->detach();
            // $post->tag()->detach();
            $post->delete();
            $delete = Post::find($id)->delete();
        }

        return redirect()->route('posts.indexPost')->with('success','Post deleted successfully.');
    }

}
