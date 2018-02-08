<?php

namespace App\Http\Controllers;

use App\ConstructFolderMedia;
use App\ConstructImage;
use Illuminate\Http\Request;
use Validator;

class ConstructPictureController extends Controller
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
        $folder = ConstructFolderMedia::orderBy('id','desc')->paginate(50);
        return view('construct_picture.index', ['folders'=>$folder]);
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
        $name = "";
        if($request->name == null){
            $name = "untitled";

        }
        else{
            $name = $request->name;
        }

        $folder_name = ConstructFolderMedia::where('name', 'like', $name."%")->get();
        if(sizeof($folder_name) == 0){
            $folder = new ConstructFolderMedia();
            $folder->name = $name;
            $folder->save();
            mkdir(base_path('../progress/'.$name), 0777, true);

        }
        else{
            $folder = new ConstructFolderMedia();
            $folder->name = $name."-".sizeof($folder_name);
            $folder->save();
            mkdir(base_path('../progress/'.$name."-".sizeof($folder_name)), 0777, true);
        }


        return redirect()->route('pictures.index')
            ->with('flash_message',
                'เพิ่มโฟล์เดอร์เรียบร้อยแล้ว');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $folder = ConstructFolderMedia::findOrFail($id);
        $image = ConstructImage::where('folder_id', $id)->get();
        return view('construct_picture.show', ['folder'=>$folder, 'pictures'=>$image]);
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
            'name'=>'required|unique:construct_folder_media,name,'.$id,

        ],[
            'name.required'=>'จำเป็นต้องระบุชื่อโฟลเดอร์',
            'name.unique'=>'ชื่อโฟล์เดอร์ที่ระบุถูกใช้งานแล้ว'
        ]);

// redirect on validation error
        if ( $validation->fails() ) {
            // change below as required
            return \Redirect::back()->withInput()->withErrors( $validation->messages() );
        }
        else {
            $folder = ConstructFolderMedia::findOrFail($id);
            $folder->fill($request->all())->save();


            return redirect()->route('pictures.show',$id)
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
        $folder = ConstructFolderMedia::findOrFail($id);

        //Make it impossible to delete this specific permission
        $name = $folder->name;
        $folder->delete();

         return redirect()->route('pictures.index')
             ->with('flash_message','ลบโฟล์เดอร์ '.$name.' เรียบร้อยแล้ว');

    }
}
