<?php

namespace App\Http\Controllers;

use App\ConstructFolderMedia;
use App\ConstructImage;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use File;

class ConstructImageController extends Controller
{

    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, $id)
    {
        if($request->hasFile('file'))
        {
            $folder = ConstructFolderMedia::findOrFail($id);
            $imageFile = $request->file('file');
            $imageName = uniqid().$imageFile->getClientOriginalName();

            $size = getimagesize($imageFile);
            $ratio = $size[0]/$size[1]; // width/height
            $width=0;
            $height=0;
            if( $ratio > 1) {
                $width = 800;
                $height = 800/$ratio;
            }
            else {
                $width = 600*$ratio;
                $height = 600;
            }
            $src = imagecreatefromstring(file_get_contents($imageFile));;
            $dst = imagecreatetruecolor($width,$height);
            imagecopyresampled($dst,$src,0,0,0,0,$width,$height,$size[0],$size[1]);
            imagedestroy($src);
            imagejpeg($dst,base_path('/../progress/'.$folder->name.'/').preg_replace('/\s+/', '', $imageName)); // adjust format as needed
            imagedestroy($dst);
           // $imageFile->move(base_path('/../progress/'.$folder->name), preg_replace('/\s+/', '', $imageName));


            $file_info = pathinfo(base_path('/../progress/'.$folder->name.'/'.$imageName));

                if(strtolower($file_info['extension']) == "jpg" or strtolower($file_info['extension']) == "jpeg" or strtolower($file_info['extension']) == "png"){
                    $image = new ConstructImage();
                    $image->folder_id = $id;
                    $image->name = preg_replace('/\s+/', '', $imageName);
                    $image->save();
                    return response()->json(['Status'=>true, 'Message'=>'Image(s) Uploaded.']);
                }
                else{
                    if(strtolower($file_info['extension']) == "zip" or strtolower($file_info['extension']) == "rar"){
                        $zip = new ZipArchive;
                        $res = $zip->open(base_path('/../progress/'.$folder->name.'/'.$imageName));
                        if ($res === TRUE) {
                            // extract it to the path we determined above
                            $zip->extractTo(base_path('/../progress/'.$folder->name));
                            $zip->close();
                            $all_images = ConstructImage::where('folder_id', $id)->get();
                            foreach(glob(base_path('/../progress/'.$folder->name.'/*.*')) as $filename){
                                foreach ($all_images as $all_image){
                                    if($filename != $all_image->name){
                                        $newname = uniqid().preg_replace('/\s+/', '', $filename);
                                        rename(base_path('/../progress/'.$folder->name.'/'.$filename), $newname);
                                        $image = new ConstructImage();
                                        $image->folder_id = $id;
                                        $image->name = $newname;
                                        $image->save();
                                    }
                                }
                            }

                            return response()->json(['Status'=>true, 'Message'=>'แตกไฟล์เรียบร้อยแล้ว']);
                        } else {
                            return response()->json(['Status'=>true, 'Message'=>' ไม่สามารถแตกไฟล์ได้']);
                        }
                    }
                }



        }

        //return redirect()->back();
    }


    public function destroy($id){
        $images = ConstructImage::findOrFail($id);
        $id = $images->folder_id;
        $name = $images->name;
        $file_path = base_path('/../progress').'/'.$images->folder->name.'/'.$images->name;
        unlink($file_path);
        $images->delete();

        return redirect()->route('pictures.show', $id)
            ->with('flash_message','ลบไฟล์ '.$name.' เรียบร้อยแล้ว');
    }
}
