<?php

namespace App\Http\Controllers;

use App\Construct;
use App\ConstructFolderMedia;
use App\ConstructPercent;
use App\Language;
use Illuminate\Http\Request;
use Validator;
use App\ConstructTranslation;

class ConstructController extends Controller
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
        $constructs = Construct::orderBy('id','desc')->paginate(10);
        $percent = ConstructPercent::first();
        return view('construct.index', ['constructs'=>$constructs, 'percent'=>$percent]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = Language::all();
        $folders = ConstructFolderMedia::orderBy('id','desc')->get();
        return view('construct.create')->with(['languages'=>$language, 'folders'=>$folders]);
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
        $validate = [];
        foreach($languages as $language){
            $validate['title'.$language->abbreviation] = 'required';
            $validate['content'.$language->abbreviation] = 'required';
            $validate['folder'] = 'required';
            $validate['date'] = 'required';

        }

        $message = [];
        foreach($languages as $language){
            $message['title'.$language->abbreviation.'.required'] = 'จำเป็นต้องระบุชื่อในภาษา'.$language->name;
            $message['content'.$language->abbreviation.'.required'] = 'จำเป็นต้องระบุเนื้อหาในภาษา'.$language->name;
            $message['folder.required'] = 'จำเป็นต้องระบุโฟลเดอร์';
            $validate['date.required'] = 'จำเป็นต้องระบุวันที่เผยแพร่';

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
                $construct = new Construct();
                $construct->status_id = 2;
                $construct->publish_date = $request->date;
                $construct->folder_id = $request->folder;
                $construct->save();

                $translation = Construct::findOrFail($construct->id);
                $language = Language::all();
                foreach ($language as $language){
                    $construct_translation = new ConstructTranslation(['local'=>$language->abbreviation,'title'=>$request['title'.$language->abbreviation],'content'=>$request['content'.$language->abbreviation]]);
                    $translation->translationSave()->save($construct_translation);
                }






            return redirect()->route('construct.index')
                ->with('flash_message',
                    'เพิ่มความคืบหน้าโครงการเรียบร้อยแล้ว');




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
        $language = Language::all();
        $folders = ConstructFolderMedia::orderBy('id','desc')->get();
        $construct = Construct::findOrFail($id);
        return view('construct.edit')->with(['languages'=>$language, 'folders'=>$folders, 'construct'=>$construct]);
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
            $validate['content'.$language->abbreviation] = 'required';
            $validate['folder'] = 'required';
            $validate['date'] = 'required';

        }

        $message = [];
        foreach($languages as $language){
            $message['title'.$language->abbreviation.'.required'] = 'จำเป็นต้องระบุชื่อในภาษา'.$language->name;
            $message['content'.$language->abbreviation.'.required'] = 'จำเป็นต้องระบุเนื้อหาในภาษา'.$language->name;
            $message['folder.required'] = 'จำเป็นต้องระบุโฟลเดอร์';
            $validate['folder.required'] = 'จำเป็นต้องระบุวันที่เผยแพร่';

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
            $construct = Construct::findOrFail($id);
            $construct->publish_date = $request->date;
            $construct->folder_id = $request->folder;
            $construct->save();

            $language = Language::all();
            foreach ($language as $language){
                $translation = ConstructTranslation::where('construct_id',$id)->where('local', $language->abbreviation)->first();
                $translation->title = $request['title'.$language->abbreviation];
                $translation->content = $request['content'.$language->abbreviation];
                $translation->save();
            }


            return redirect()->route('construct.edit',$id)
                ->with('flash_message',
                    'บันทึกความคืบหน้าโครงการเรียบร้อยแล้ว');
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
        $construct_translation = ConstructTranslation::where('construct_id',$id);
        $construct_translation->delete();
        $construct = Construct::findOrFail($id);
        $construct->delete();
        return redirect()->route('construct.index')
            ->with(['flash_message'=>
                'ลบความคืบหน้าเรียบร้อยแล้ว']);

    }

    public function destroyMany(Request $request){
        if ($request->multi_id != null){
            $construct = Construct::findOrFail($request->multi_id);

            foreach ($construct as $construct){
                $construct_translation = ConstructTranslation::where('construct_id',$construct->id);
                $construct_translation->delete();


            }
            $construct->delete();
            return redirect()->route('construct.index')
                ->with(['flash_message'=>
                    'ลบความคืบหน้าเรียบร้อยแล้ว']);

        }
        else{
            return redirect()->route('construct.index')
                ->with('warning',
                    'กรุณาเลือกความคืบหน้าอย่างน้อย 1 ข้อมูล');

        }

    }

    public function update_status($id){
        $construct = Construct::findOrFail($id);
        $construct->status_id = 1;
        $construct->save();
        return redirect()->route('dashboard')
            ->with('flash_message',
                'อนุมัติความคืบหน้าเรียบร้อยแล้ว');
    }
}
