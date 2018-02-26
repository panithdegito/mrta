<?php

namespace App\Http\Controllers;

use App\Language;
use App\Station;
use App\StationFolder;
use App\StationStatus;
use App\StationTranslation;
use Illuminate\Http\Request;
use App\ConstructPercent;
use Spatie\Permission\Models\Role;
use Validator;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::paginate(10);
        $percent = ConstructPercent::first();
        return view('stations.index', ['stations'=>$stations, 'percent'=>$percent]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = Language::all();
        $status = StationStatus::all();
        $role = Role::all();
        return view('stations.create', ['status'=>$status, 'languages'=>$language, 'roles'=>$role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $languages = Language::all();
        $validate = ['code'=>'required|unique:stations', 'progress'=>'required', 'kilometer'=>'required', 'status'=>'required'];
        foreach($languages as $language){
            $validate['name'.$language->abbreviation] = 'required';

        }

        $message = ['code.required'=>'จำเป็นต้องระบุรหัสสถานี', 'kilometer.required'=>'จำเป็นต้องระบุกิโลเมตรที่ตั้ง', 'status.required'=>'จำเป็นต้องกำหนดสถานะ', 'progress.required'=>'จำเป็นต้องระบุเปอร์เซนต์ความคืบหน้า', 'code.unique'=>'รหัสสถานีที่ระบุถูกใช้งานแล้ว'];
        foreach($languages as $language){
            $message['name'.$language->abbreviation.'.required'] = 'จำเป็นต้องระบุชื่อในภาษา'.$language->name;

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
            $station = new Station();
            $station->code = $request->code;
            $station->kilometer_marker = $request->kilometer;
            $station->status_id = $request->status;
            $station->progress = $request->progress;
            $station->save();

            $translation = Station::findOrFail($station->id);
            $language = Language::all();
            foreach ($language as $language){
                $station_translation = new StationTranslation(['local'=>$language->abbreviation,'name'=>$request['name'.$language->abbreviation]]);
                $translation->translationSave()->save($station_translation);
            }






            return redirect()->route('stations.index')
                ->with('flash_message',
                    'เพิ่มสถานีเรียบร้อยแล้ว');




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
        $station = Station::findOrFail($id);
        $folder = StationFolder::orderBy('id','desc')->where('station_id', $id)->paginate(50);
        return view('stations.show', ['folders'=>$folder, 'station'=>$station]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $languages = Language::all();
        $station = Station::findOrFail($id);
        $status = StationStatus::all();
        return view('stations.edit', ['status'=>$status, 'station'=>$station, 'languages'=>$languages]);
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
        $validate = ['code'=>'required|unique:stations,code,'.$id, 'progress'=>'required', 'kilometer'=>'required', 'status'=>'required'];
        foreach($languages as $language){
            $validate['name'.$language->abbreviation] = 'required';

        }

        $message = ['code.required'=>'จำเป็นต้องระบุรหัสสถานี', 'kilometer.required'=>'จำเป็นต้องระบุกิโลเมตรที่ตั้ง', 'status.required'=>'จำเป็นต้องกำหนดสถานะ', 'progress.required'=>'จำเป็นต้องระบุเปอร์เซนต์ความคืบหน้า', 'code.unique,station,'.$id=>'รหัสสถานีที่ระบุถูกใช้งานแล้ว'];
        foreach($languages as $language){
            $message['name'.$language->abbreviation.'.required'] = 'จำเป็นต้องระบุชื่อในภาษา'.$language->name;

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
            $station = Station::findOrFail($id);
            $station->code = $request->code;
            $station->kilometer_marker = $request->kilometer;
            $station->status_id = $request->status;
            $station->progress = $request->progress;
            $station->save();
            $language = Language::all();
            foreach ($language as $language){
                $station_translation = StationTranslation::where('local',$language->abbreviation)->where('station_id', $id)->first();
                $station_translation->name = $request['name'.$language->abbreviation];
                $station_translation->save();
            }
            return redirect()->route('stations.edit',$id)
                ->with('flash_message',
                    'บันทึกสถานีเรียบร้อยแล้ว');
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
        $station = Station::findOrFail($id);
        if($station->status_id == 3){
            $station_translation = StationTranslation::where('station_id', $id);
            $station_translation->delete();
            $station->delete();
            return redirect()->route('stations.index')
                ->with('flash_message',
                    'ลบสถานีเรียบร้อยแล้ว');
        }else{
            return redirect()->route('stations.index')
                ->with('danger',
                    'ไม่สามารถลบสถานีที่มีสถานะใช้งาน หรือ กำลังก่อสร้างได้');

        }

    }

    public function destroyMany(Request $request)
    {
        if(sizeof($request->multi_id) > 0){
            for($i=0 ; $i < sizeof($request->multi_id) ; $i++){
                $station = Station::findOrFail($request->multi_id[$i]);
                if($station->status_id == 3){
                    $station_translation = StationTranslation::where('station_id', $request->multi_id[$i]);
                    $station_translation->delete();
                    $station->delete();
                    return redirect()->route('stations.index')
                        ->with('flash_message',
                            'ลบสถานีที่เลือกเรียบร้อยแล้ว');
                }else{
                    return redirect()->route('stations.index')
                        ->with('danger',
                            'ไม่สามารถลบสถานีที่มีสถานะใช้งาน หรือ กำลังก่อสร้างได้');

                }
            }

        }
        else{
            return redirect()->route('stations.index')
                ->with('warning',
                    'กรุณาเลือกสถานีอย่างน้อย 1 สถานี');

        }

    }
}
