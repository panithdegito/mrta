<?php

namespace App\Http\Controllers;

use App\Station;
use App\StationFolder;
use App\StationFolderImage;
use Illuminate\Http\Request;
use Validator;

class StationFolderController extends Controller
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
        $folder = StationFolder::orderBy('id','desc')->paginate(50);
        return view('stations.show', ['folders'=>$folder]);
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
    public function store(Request $request, $id)
    {
        $station = Station::findOrFail($id);
        $name = "";
        if($request->name == null){
            $name = "untitled";

        }
        else{
            $name = $request->name;
        }

        $folder_name = StationFolder::where('name', 'like', $name."%")->get();
        if(sizeof($folder_name) == 0){
            $folder = new StationFolder();
            $folder->name = $name;
            $folder->station_id = $id;
            $folder->save();
            mkdir(base_path('../progress/'.$station->code.'/'.$name), 0777, true);

        }
        else{
            $folder = new StationFolder();
            $folder->name = $name."-".sizeof($folder_name);
            $folder->station_id = $id;
            $folder->save();
            mkdir(base_path('../progress/'.$station->code.'/'.$name."-".sizeof($folder_name)), 0777, true);
        }


        return redirect()->route('stations.show', $id)
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
        $folder = StationFolder::findOrFail($id);
        $image = StationFolderImage::where('folder_id', $id)->orderBy('id', 'desc')->get();
        return view('stations_image.show', ['folder'=>$folder, 'pictures'=>$image]);
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
            'name'=>'required|unique:station_folders,name,'.$id,

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
            $folder = StationFolder::findOrFail($id);
            $folder->fill($request->all())->save();


            return redirect()->route('show_folder',$id)
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
        $folder = StationFolder::findOrFail($id);

        //Make it impossible to delete this specific permission
        $name = $folder->name;
        $station = $folder->station_id;
        $folder->delete();

        return redirect()->route('stations.show', $station)
            ->with('flash_message','ลบโฟล์เดอร์ '.$name.' เรียบร้อยแล้ว');

    }
}
