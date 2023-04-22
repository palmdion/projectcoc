<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AlumniImport;
use Illuminate\Support\Facades\DB;

use App\Models\CategoryWork;
use App\Models\Alumni;
use App\Models\User;
use App\Models\Work;
use App\Models\UserAlumni;
use App\Models\Education;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class AlumniController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function importAlumni()
    {
        return view('admin.users.alumniImport');
    }

    public function uploadAlumni(Request $request)
    {
        try {
            //$file = $request->file('file')->store("public/import");
            //$import = new AlumniImport;
            //$mport->uploadAlumni($file);
            Excel::import(new AlumniImport, $request->file);

            return redirect()->route('users.index')->with('success', 'Alumni Imported Successfully');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
        //Excel::import(new AlumniImport, $request->file);

        //return redirect()->route('users.index')->with('success', 'Alumni Imported Successfully');
    }

    public function verifyAlumni(Request $request){
        $alumni = Alumni::where('student_name_th', $request->name_student)->where('student_surname_th', $request->surname_student)->where('used', 0)->get();
        if(count($alumni) != 0){
            $alumni = $alumni->first();
            $alumni->used = 1;
            $alumni->save();

            $joinUser = new UserAlumni;
            $joinUser->user_id = Auth::id();
            $joinUser->alumni_id = $alumni->id;
            $joinUser->save();

            $user = User::find(Auth::id());
            $user->alumni = 1;
            $user->save();

            return redirect()->route('profile.manageProfile')->with('success', 'Alumni Update Successfully');
        }else{
            return redirect()->route('profile.manageProfile')->with('error', 'Alumni Data Not found');
        }
    }


    public function addEducation(Request $request){
        $education = new Education;
        $education->user_id = Auth::id();
        $education->depart_id = $request->departId;
        $education->student_number = $request->studentId;
        $education->education_start = $request->start_lean;
        $education->education_end = $request->end_lean;
        $education->university = $request->unverName;
        $education->faculty = $request->faculty;

        $education->save();

        return redirect()->route('profile.manageProfile')->with('success', 'Add Education Successfully');
    }
    public function editEdu($id)
    {
        $edu = Education::find($id);
        return view('profile.editEdu', ['edu' => $edu]);
    }

    public function updateEdu(Request $request,$edu)
    {
          try {
                $education = Education::find($edu);
                $education->user_id = Auth::id();
                $education->depart_id = $request->depart_id;
                $education->education_start = $request->education_start;
                $education->education_end = $request->education_end;
                $education->student_number = $request->student_number;
                $education->faculty = $request->faculty;
                $education->university = $request->university;
                $education->save();

                return redirect()->route('profile.manageProfile')->with('success','education update successfully.');
            }catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('profile.manageProfile')->with('error',$th->getMessage());
            }
    }
    public function deleteEdu(Education $education,$id)
    {
        $education->delete();
        $delete = Education::find($id)->delete();
        return redirect()->route('profile.manageProfile')->with('success','Education deleted successfully.');
    }

    public function editWork($id)
    {
        $work = Work::find($id);
        $cateWork = CategoryWork::all();
        return view('profile.editwork', ['work' => $work , 'cateWork' => $cateWork]);
    }
    public function updateWork(Request $request,$work)
    {
          try {
                $work = Work::find($work);
                $work->user_id = Auth::id();
                $work->cateWork_id = $request->categories;
                $work->work_name = $request->work_name;
                $work->description = $request->description;
                $work->company_name = $request->company_name;
                $work->save();


                return redirect()->route('profile.manageProfile')->with('success','Work update successfully.');
            }catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('profile.manageProfile')->with('error',$th->getMessage());
            }
    }
    public function deleteWork(Work $work,$id)
    {
        $work->delete();
        $delete = Work::find($id)->delete();
        return redirect()->route('profile.manageProfile')->with('success','Work deleted successfully.');
    }

    public function addWork(Request $request){
        $work = new Work();
        $work->user_id = Auth::id();
        $work->cateWork_id = $request->categories;
        $work->work_name = $request->name_work;
        $work->description = $request->work_detail;
        $work->company_name = $request->name_company;
        $work->save();

        return redirect()->route('profile.manageProfile')->with('success', 'Add Work Successfully');
    }
}
