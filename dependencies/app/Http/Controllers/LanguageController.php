<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;
use Validator;

class LanguageController extends Controller
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
        $language = Language::orderBy('id','desc')->paginate(10);
        return view('language.index')->with('languages',$language);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('language.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the input
        $validation = Validator::make( $request->all(), [
            'name'=>'required|unique:languages',
            'abbreviation' =>'required|size:2|unique:languages',

        ],[
            'name.required' => 'จำเป็นต้องระบุชื่อ',
            'abbreviation.required' => 'จำเป็นต้องระบุคำย่อ',
            'abbreviation.size' => 'คำย่อต้องมีทั้งหมด 2 ตัวอักษร',
            'abbreviation.unique' => 'คำย่อต้องไม่ซ้ำ'

        ]);

// redirect on validation error
        if ( $validation->fails() ) {
            // change below as required
            return \Redirect::back()->withInput()->withErrors( $validation->messages() );
        }
        else {
            $language = new Language();
            $input = $request->all();
            $language->fill($input)->save();


            return redirect()->route('languages.index')
                ->with('flash_message',
                    $language->name.' added.');


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
        return redirect()->route('languages.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = Language::findOrFail($id);
        return view('language.edit')->with('language',$language);
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
            'name'=>'required|unique:languages,name,'.$id,
            'abbreviation' =>'required|size:2|unique:languages,abbreviation,'.$id,

        ]);

// redirect on validation error
        if ( $validation->fails() ) {
            // change below as required
            return \Redirect::back()->withInput()->withErrors( $validation->messages() );
        }
        else {
            $language = Language::findOrFail($id);
            $input = $request->all();
            $language->fill($input)->save();


            return redirect()->route('languages.edit',$id)
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
        $language = Language::findOrFail($id);

        if ($language->default == 1) {
            return redirect()->route('languages.index')
                ->with('danger',
                    'ไม่สามารถลบภาษานี้ได้ เนื่องจากภาษาดังกล่าวเป็นค่าเริ่มต้นของระบบ');
        }
        else{
            $language->delete();
            return redirect()->route('permissions.index')
                ->with('flash_message',
                    'Language deleted.');
        }
    }

    public function destroyMany(Request $request){
        if ($request->multi_id != null){
            $language = Language::findOrFail($request->multi_id);

            //Make it impossible to delete this specific permission
            $msg = "";
            $count_error=0;
            $count_delete=0;
            foreach ($language as $language){
                if ($language->default == 1) {
                    if($count_error == 0){
                        $msg .= "".$language->name;
                    }
                    else{
                        $msg .= " , ".$language->name;
                    }
                    $count_error++;

                }
                else{
                    $language->delete();
                    $count_delete++;
                }

            }
            if($count_error != 0 && $count_delete != 0){
                return redirect()->route('languages.index')
                    ->with(['flash_message'=>
                        'ลบภาษาเรียบร้อยแล้ว','danger'=>'ไม่สามารถลบภาษา'.$msg."ได้ เนื่องจากภาษาดังกล่าวเป็นค่าเริ่มต้นของระบบ"]);
            }
            else if($count_error == 0 && $count_delete != 0){
                return redirect()->route('languages.index')
                    ->with(['flash_message'=>
                        'ลบภาษาเรียบร้อยแล้ว']);
            }
            else if($count_error != 0 && $count_delete == 0){
                return redirect()->route('languages.index')
                    ->with(['danger'=>'ไม่สามารถลบภาษา'.$msg."ได้ เนื่องจากภาษาดังกล่าวเป็นค่าเริ่มต้นของระบบ"]);
            }

        }
        else{
            return redirect()->route('languages.index')
                ->with('warning',
                    'กรุณาเลือกภาษาอย่างน้อย 1 ภาษา');

        }

    }

    public function makeDefault($id){
        $languages = Language::all();
        foreach ($languages as $language){
            $language->default = 0;
            $language->save();
        }
        $language = Language::findOrFail($id);
        $language->default = 1;
        $language->save();
        return redirect()->route('languages.index')
            ->with('flash_message',
                'ตั้งเป็นค่าเริ่มต้นเรียบร้อยแล้ว');

    }
}
