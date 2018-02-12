<?php

namespace App\Http\Controllers;

use App\NewsCategory;
use App\NewsCategoryTranslation;
use Illuminate\Http\Request;
use App\Language;
use Validator;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = NewsCategory::orderBy('id', 'desc')->paginate(10);
        return view('news-categories.index', ['news_categories'=>$news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = Language::all();
        return view('news-categories.create')->with(['languages'=>$language]);
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
            $validate['name'.$language->abbreviation] = 'required';

        }

        $message = [];
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
            $categories = new NewsCategory();
            $categories->save();


            $translation = NewsCategory::findOrFail($categories->id);
            $language = Language::all();
            foreach ($language as $language){
                $categorie_translation = new NewsCategoryTranslation(['local'=>$language->abbreviation,'name'=>$request['name'.$language->abbreviation]]);
                $translation->translationSave()->save($categorie_translation);
            }






            return redirect()->route('news-categories.index')
                ->with('flash_message',
                    'เพิ่มประเภทข่าวสารเรียบร้อยแล้ว');




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
        $category = NewsCategory::findOrFail($id);
        return view('news-categories.edit')->with(['languages'=>$language,'category'=>$category]);
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
            $validate['name'.$language->abbreviation] = 'required';

        }

        $message = [];
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
            $category = NewsCategory::findOrFail($id);
            $category->save();

            $language = Language::all();
            foreach ($language as $language){
                $translation = NewsCategoryTranslation::where('news_category_id',$id)->where('local', $language->abbreviation)->first();
                $translation->name = $request['name'.$language->abbreviation];
                $translation->save();
            }
            return redirect()->route('news-categories.edit',$id)
                ->with('flash_message',
                    'แก้ไขประเภทข่าวสารเรียบร้อยแล้ว');




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
        $category_translation = NewsCategoryTranslation::findOrFail('news_category_id',$id);
        $category_translation->delete();
        $category = NewsCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('news-categories.index')
            ->with(['flash_message'=>
                'ลบประเภทข่าวสารเรียบร้อยแล้ว']);
    }
    public function destroyMany(Request $request){
        if ($request->multi_id != null){
            $category = NewsCategory::findOrFail($request->multi_id);

            foreach ($category as $category){
                $translation = NewsCategoryTranslation::where('news_category_id',$category->id);
                $translation->delete();


            }
            $category->delete();
            return redirect()->route('news-categories.index')
                ->with(['flash_message'=>
                    'ลบประเภทข่าวสารเรียบร้อยแล้ว']);

        }
        else{
            return redirect()->route('news-categories.index')
                ->with('warning',
                    'กรุณาเลือกประเภทข่าวสารอย่างน้อย 1 ประเภท');

        }

    }
}
