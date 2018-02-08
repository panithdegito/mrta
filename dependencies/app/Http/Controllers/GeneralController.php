<?php

namespace App\Http\Controllers;

use App\GeneralTranslation;
use Illuminate\Http\Request;
use App\General;
use App\Language;
use Validator;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $general = General::first();
        $languages = Language::all();
        return view('generals.edit',['general' => $general, 'languages' => $languages]);
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
        $languages = Language::all();
        $validate = [];
        foreach($languages as $language){
            $validate['title'.$language->abbreviation] = 'required';
            $validate['description'.$language->abbreviation] = 'required';
            $validate['keyword'.$language->abbreviation] = 'required';

        }

        $message = [];
        foreach($languages as $language){
            $message['title'.$language->abbreviation.'.required'] = 'จำเป็นต้องระบุชื่อในภาษา'.$language->name;
            $message['description'.$language->abbreviation.'.required'] = 'จำเป็นต้องระบุคำอธิบาย (meta description) ในภาษา'.$language->name;
            $message['keyword'.$language->abbreviation.'.required'] = 'จำเป็นต้องระบุคำคีย์เวิร์ด (meta keyword) ในภาษา'.$language->name;

        }
        // validate the input
        $validation = Validator::make( $request->all(),$validate, $message
        );

// redirect on validation error
        if ( $validation->fails() ) {
            // change below as required
            return \Redirect::back()->withInput()->withErrors( $validation->messages() );
        }
        else {
            foreach($languages as $language){
                $general  = GeneralTranslation::where('general_id', $id)->where('local', $language->abbreviation)->first();
                $general->title = $request['title'.$language->abbreviation];
                $general->description = $request['description'.$language->abbreviation];
                $general->keyword = $request['keyword'.$language->abbreviation];
                $general->save();
            }





            return redirect()->route('generals.index')
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
