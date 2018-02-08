<?php

namespace App\Http\Controllers;

use App\DefaultStatus;
use Illuminate\Http\Request;
use Validator;

class StatusController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'manageSetting']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = DefaultStatus::orderBy('id','desc')->get();
        return view('statuses.index')->with('statuses',$statuses);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $status = DefaultStatus::findOrFail($id);
        return view('statuses.edit')->with('status',$status);
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
        $status = DefaultStatus::findOrFail($id);
        // validate the input
        $validation = Validator::make( $request->all(), [
            'name'=>'required',
        ]);
// redirect on validation error
        if ( $validation->fails() ) {
            // change below as required
            return \Redirect::back()->withInput()->withErrors( $validation->messages() );
        }
        else {
            $input = $request->all();
            $status->fill($input)->save();

            return redirect()->route('statuses.edit',$id)
                ->with('flash_message',
                    'บันทึกข้อมูลเรียบร้อยแล้ว');
        }
    }

}
