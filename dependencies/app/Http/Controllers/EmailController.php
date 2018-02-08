<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;
use Validator;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email = Email::findOrFail(1);
        return view('email.edit',['email' => $email]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        // validate the input
        $validation = Validator::make( $request->all(), [
            'receiver_name'=>'required',
            'receiver_email'=>'required|email',
            'sender_name'=>'required',
            'sender_host'=>'required',
            'sender_port'=>'required|numeric',
            'sender_username'=>'required',
            'sender_password'=>'required',

        ],[
            'receiver_name.required'=>'จำเป็นต้องระบุชื่อของอีเมลผู้รับ',
            'receiver_email.required'=>'จำเป็นต้องระบุอีเมลผู้รับ',
            'receiver_email.email'=>'ป้อนอีเมลในรูปแบบ someone@example.com',
            'sender_name.required'=>'จำเป็นต้องระบุอชื่อผู้ส่ง',
            'sender_host.required'=>'จำเป็นต้องระบุโฮสของอีเมลส่งออก',
            'sender_port.required'=>'จำเป็นต้องระบุพอร์ต',
            'sender_port.numeric'=>'พอร์ตต้องเป็นตัวเลขเท่านั้น',
            'sender_username.required'=>'จำเป็นต้องระบุชื่อผู้ใช้งาน หรืออีเมลที่ใช้ส่งออก',
            'sender_password.required'=>'จำเป็นต้องระบุรหัสผ่าน',

        ]);

// redirect on validation error
        if ( $validation->fails() ) {
            // change below as required
            return \Redirect::back()->withInput()->withErrors( $validation->messages() );
        }
        else {
            $email = Email::findOrFail($id);
            $email->receiver_name = $request->receiver_name;
            $email->receiver_email = $request->receiver_email;
            $email->sender_name = $request->sender_name;
            $email->sender_host = $request->sender_host;
            $email->sender_port = $request->sender_port;
            $email->sender_username = $request->sender_username;
            $email->sender_password = $request->password;
            $email->sender_encryption = $request->sender_encryption;


            return redirect()->route('email.index')
                ->with('flash_message',
                    'บันทึกข้อมูลเรียบร้อยแล้ว');


        }
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
