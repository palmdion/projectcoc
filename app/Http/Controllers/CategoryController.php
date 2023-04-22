<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Post;


class CategoryController extends Controller
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
        $categories = Category::paginate(5);

        return view('admin.posts.category.index', ['categories' => $categories] );
    }

    /**
     *  d
     */

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'cate_name' => 'required',
                'description' => 'required'
            ]);
            Category::create($request->all());

            DB::commit();
            return redirect()->route('category.index')->with('success','Categories created successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('category.index')->with('error',$th->getMessage());
        }

    }
    public function edit($id)
    {
        $categories = Category::find($id);
        return view('admin.posts.category.edit', ['categories' => $categories]);
    }


    public function update(Request $request ,$id)
    {
        try {
            $categories = Category::find($id);
            $categories->cate_name = $request->cate_name;
            $categories->description = $request->description;
            $categories->save();


            return redirect()->route('category.index')->with('success','Category update successfully.');
            }catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('category.index')->with('error',$th->getMessage());
            }
    }

    public function delete($id)
    {
        $delete = Category::find($id)->delete();
        return redirect()->route('category.index')->with('success','Category deleted successfully.');
    }
}
