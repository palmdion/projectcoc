<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use App\Models\Department;
use App\Models\Degree;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $education = Education::all();
        return view('admin.education.index', compact('education'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.education.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

          try {
                $education = new Education();
                $education->user_id = Auth::id();
                $education->degreeName = $request->degreeName;
                $education->departName = $request->departName;
                $education->education_start = $request->education_start;
                $education->education_end = $request->education_end;
                $education->student_number = $request->student_number;
                $education->faculty = $request->faculty;
                $education->university = $request->university;
                $education->save();


                return redirect()->route('education.index')->with('success','education create successfully.');
            }catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('education.create')->with('error',$th->getMessage());
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
