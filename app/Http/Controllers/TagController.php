<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Tag;

class TagController extends Controller
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

    public function index()
    {
        $tags = Tag::paginate(5);
        return view('admin.posts.tag.index', ['tags' => $tags] );
    }

    /**
     *  d
     */

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'tag_name' => 'required',
                'description' => 'required'
            ]);
            Tag::create($request->all());

            DB::commit();
            return redirect()->route('tag.index')->with('success','Tag created successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('tag.index')->with('error',$th->getMessage());
        }

    }

    public function edit($id)
    {
        $tags = Tag::find($id);
        return view('admin.posts.tag.edit', ['tags' => $tags]);
    }


    public function update(Request $request ,$id)
    {
        //อัพเดทข้อมูล
          $tags = Tag::find($id)->update([
            'tag_name' =>$request->tag_name,
            'description' =>$request->description,
          ]);
          DB::commit();
          return redirect()->route('tag.index')->with('success','tag updated successfully.');
    }

    public function delete($id)
    {
        $delete = Tag::find($id)->delete();
        return redirect()->route('tag.index')->with('success','Tag deleted successfully.');
    }
}
