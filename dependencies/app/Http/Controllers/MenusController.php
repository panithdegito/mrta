<?php

namespace App\Http\Controllers;

use App\Language;
use App\Menu;
use Illuminate\Http\Request;
use Validator;
use App\MenuTranslation;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::orderBy('ordering')->get();
        $languages = Language::all();
        return view('menus.index',['menus'=>$menus,'languages'=>$languages]);
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
        $languages = Language::all();
        $validate = ['path'=>'required'];
        foreach($languages as $language){
            $validate['name'.$language->abbreviation] = 'required';

        }

        $message = ['path.required'=>'จำเป็นต้องระบุลิงค์'];
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
            $max_ordering = Menu::max('ordering');
            $menu = new Menu();
            $menu->link = $request->path;
            $menu->ordering = $max_ordering+1;
            $menu->subordering = 0;
            $menu->childof = 0;
            $menu->save();



            $translation = Menu::findOrFail($menu->id);
            $language = Language::all();
            foreach ($language as $language){
                $menu_translation = new MenuTranslation(['local'=>$language->abbreviation,'name'=>$request['name'.$language->abbreviation]]);
                $translation->translationSave()->save($menu_translation);
            }






            return redirect()->route('menus.index')
                ->with('flash_message',
                    'เพิ่มเมนูไอเท็มเรียบร้อยแล้ว');




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
        $menus = Menu::findOrFail($id);
        $languages = Language::all();
        return view('menus.edit',['menu'=>$menus,'languages'=>$languages]);
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
        $validate = ['path'=>'required'];
        foreach($languages as $language){
            $validate['name'.$language->abbreviation] = 'required';

        }

        $message = ['path.required'=>'จำเป็นต้องระบุลิงค์'];
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
            $menu = Menu::findOrFail($id);
            $menu->link = $request->path;
            $menu->save();



            $language = Language::all();
            foreach ($language as $language){
                $translation = MenuTranslation::where('menu_id',$id)->where('local', $language->abbreviation)->first();
                $translation->name = $request['name'.$language->abbreviation];
                $translation->save();
            }






            return redirect()->route('menus.edit',$id)
                ->with('flash_message',
                    'แก้ไขเมนูไอเท็มเรียบร้อยแล้ว');
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
        $menu_translation = MenuTranslation::where('menu_id',$id);
        $menu_translation->delete();
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect()->route('menus.index')
            ->with('flash_message',
                'ลบเมนูไอเท็มเรียบร้อยแล้ว');
    }
}
