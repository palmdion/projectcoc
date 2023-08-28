<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AlumniImport;
use Illuminate\Support\Facades\DB;

use App\Models\CategoryWork;
use App\Models\Alumni;
use App\Models\AlumniImport as AlumniImportModel;
use App\Models\User;
use App\Models\Work;
use App\Models\UserAlumni;
use App\Models\Education;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

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

    public function deleteAlumniPre(AlumniImportModel $id){
        AlumniImportModel::find($id->id)->delete();

        $alumniPre = AlumniImportModel::get();

        return view('admin.users.alumni.preview', ['alumnis' => $alumniPre]);

    }

    public function addAlumni(Request $request){
        $alumniPres = AlumniImportModel::get()->all();
        foreach ($alumniPres as $alumnPre) {
            $checkStd  = Alumni::where('student_code', $alumnPre['student_code'])->first();
            if(!$checkStd){
                $alumni =  new Alumni;
                $alumni->student_code = $alumnPre['student_code'];
                $alumni->student_name_th = $alumnPre['student_name_th'];
                $alumni->student_surname_th = $alumnPre['student_surname_th'];
                $alumni->student_name_en = $alumnPre['student_name_en'];
                $alumni->student_surname_en = $alumnPre['student_surname_en'];
                $alumni->program_name = $alumnPre['program_name'];
                $alumni->faculty_name = $alumnPre['faculty_name'];
                $alumni->admit_year = $alumnPre['admit_year'];
                $alumni->degree = $request->education;
                $alumni->used = 0;
                $alumni->save();
            }



        }

        return redirect()->route('alumni.indexAlumni')->with('success', 'Alumni Imported Successfully');
    }

    public function uploadAlumni(Request $request)
    {
        try {
            AlumniImportModel::query()->delete();

            Excel::import(new AlumniImport, $request->file);

            $alumniPre = AlumniImportModel::get();

            return view('admin.users.alumni.preview', ['alumnis' => $alumniPre]);

            // return redirect()->route('users.alumni.preview')->with('success', 'Alumni Imported Successfully');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
        //Excel::import(new AlumniImport, $request->file);
        //return redirect()->route('users.index')->with('success', 'Alumni Imported Successfully');
    }

    public function verifyAlumni(Request $request){
        $alumni = Alumni::where('student_name_th', $request->name_student)->where('student_surname_th', $request->surname_student)
                        ->where('used', 0)->get();
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

            return redirect()->route('profile.myEducation')->with('success', 'Alumni Update Successfully');
        }else{
            return redirect()->route('profile.myEducation')->with('error', 'Alumni Data Not found');
        }
    }


    public function addEducation(Request $request){

        $education = new Education;
        $education->user_id = Auth::id();
        $education->degreeName = $request->degreeName;
        $education->departName = $request->departName;
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
                $education->degreeName = $request->degreeName;
                $education->departName = $request->departName;
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
        return view('profile.editwork', ['work' => $work ]);
    }
    public function updateWork(Request $request,$work)
    {
          try {
                $work = Work::find($work);
                $work->user_id = Auth::id();
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
        $work->work_name = $request->name_work;
        $work->description = $request->work_detail;
        $work->company_name = $request->name_company;
        $work->save();

        return redirect()->route('profile.manageProfile')->with('success', 'Add Work Successfully');
    }

    public function indexAlumni()
    {
        $alumnis = Alumni::orderBy('id', 'desc')->paginate(50);
        return view('admin.users.alumni.indexAlumni', ['alumnis' => $alumnis]);

    }
    public function editAlumni(Alumni $alumni)
    {
        return view('admin.users.alumni.editAlumni', ['alumni' => $alumni]);
    }
    public function update(Request $request, $id)
    {
          try {
                $alumni = Alumni::find($id);
                $alumni->student_name_th = $request->student_name_th;
                $alumni->student_surname_th = $request->student_surname_th;
                $alumni->student_name_en = $request->student_name_en;
                $alumni->student_surname_en = $request->student_surname_en;
                $alumni->program_name = $request->program_name;
                $alumni->faculty_name = $request->faculty_name;
                $alumni->admit_year = $request->admit_year;
                $alumni->save();

                return redirect()->route('alumni.indexAlumni')->with('success','update successfully.');
            }catch (\Throwable $th) {
                DB::rollback();
                return redirect()->back()->with('error',$th->getMessage());
            }
    }
    public function showAlumni($alumni)
    {
        $alumni = Alumni::find($alumni);
        return view('admin.users.alumni.showAlumni',['alumni'=>$alumni]);
    }

    public function searchAlumni(Request $request)
    {
        $keyword = $request->input('keywordAlum');

        $alumnis = Alumni::where('id', 'like','%'. $keyword.'%')
                ->orWhere('student_code', 'like', "%$keyword%")
                ->orWhere('student_name_th', 'like', "%$keyword%")
                ->orWhere('student_name_th', 'like', "%$keyword%")
                ->orWhere('student_surname_th', 'like', "%$keyword%")
                ->orWhere('student_surname_en', 'like', "%$keyword%")
                ->orWhere('program_name', 'like', "%$keyword%")
                ->orWhere('faculty_name', 'like', "%$keyword%")
                ->orWhere('degree', 'like', "%$keyword%")
                ->orWhere('admit_year', 'like', "%$keyword%")
                ->get();
         return view('admin.users.alumni.indexAlumni',compact('alumnis'));
    }

}
