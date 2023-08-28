<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SendRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class SendRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexRequest()
    {
        return view('sendRequest');
    }

    public function sendRequest(Request $request)
    {
        // Validations
        $request->validate([
            'mobile_number'    => 'required|numeric|digits:10',
            'mail_address'    => 'required',
            'subject'     => 'required',
            'description' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $send = SendRequest::create([
                'user_id'    => Auth::id(),
                'mobile_number'     => $request->mobile_number,
                'mail_address'     => $request->mail_address,
                'subject'         => $request->subject,
                'description' => $request->description,
            ]);


            DB::commit();
            return redirect()->route('sendRequest.indexRequest')->with('success','โปรดรอการตรวจสอบจากผู้ดูแลระบบ');
        }   catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('sendRequest.indexRequest')->with('error',$th->getMessage());
        }
    }

    public function index()
    {
        $sendRequest = SendRequest::get();
        return view('admin.sendRequest.index', compact('sendRequest'));

    }

    public function edit(Request $request)
    {
        $user = User::find($request->user);
        $roles = Role::all();
        return view('admin.sendRequest.edit')->with([
            'roles' => $roles,
            'send'  => $user
        ]);

    }

    public function update(Request $request)
    {

        try {
            $user = User::find($request->user); // success
            $user->role_id = $request->role_id;



            // Delete Any Existing Role
            DB::table('model_has_roles')->where('model_id',$user)->delete();

            // Assign Role To User
            $user->assignRole($user->role_id);
            $user->save();

            return redirect()->route('sendRequest.index')->with('success','update successfully.');
        }catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    public function show($id)
    {
        $send = SendRequest::find($id);
        return view('admin.sendRequest.show',['send'=>$send]);
    }

    public function delete($id)
    {
        $delete = SendRequest::find($id)->delete();
        return redirect()->route('sendRequest.index')->with('success','send request deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
