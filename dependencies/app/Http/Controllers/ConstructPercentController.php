<?php

namespace App\Http\Controllers;

use App\ConstructPercent;
use Illuminate\Http\Request;
use Validator;

class ConstructPercentController extends Controller
{

    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'percent'=>'required|numeric',

        ],[
            'percent.required'=>'จำเป็นต้องระบุความคืบหน้า',
            'percent.numeric'=>'ความคืบหน้าต้องระบุเป็นตัวเลขเท่านั้น',


        ]);
        // redirect on validation error
        if ( $validation->fails() ) {
            // change below as required
            return \Redirect::back()->withInput()->withErrors( $validation->messages() );
        }
        else {
            $percent = ConstructPercent::findOrFail($id);
            $percent->percent = $request->percent;
            $percent->save();



            return redirect()->route('stations.index')
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
