<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShipmentController extends Controller
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
        $user = User::all();
        return view('admin.mail.index' ,compact('user'));
    }
    public function send(Request $request)
    {
        $request ->validate([
            'name' => 'required',
            'email' =>'required | email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($this->isOnline()) {
            $mail_data = [
                'recipient' => 'alumnicoc.2023@gmail.com',
                'fromEmail' => $request -> email,
                'fromName' => $request -> name,
                'subject' => $request -> subject,
                'body' => $request -> message,
            ];
            \Mail::send('admin.mail.sendMail',$mail_data, function( $message ) use ($mail_data){
                $message->to($mail_data['fromEmail'])
                        ->from($mail_data['recipient'],$mail_data['fromName'])
                        ->subject($mail_data['subject']);
            });
            return redirect()->back()->with('success','Email sent');
        }else{
            return redirect()->back()->withInput()->with('error','Check your email connection');
        }

    }
    public function isOnline($site = "https://www.youtube.com/" )
    {
        if (@fopen($site , 'r')) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mail.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        Mail::to($user->email)->send(new SendMail());
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
