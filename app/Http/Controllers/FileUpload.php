<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class FileUpload extends Controller{
  public function createForm(){
    return view('image-upload');
  }

  public function fileUpload(Request $req){
    // dd($req->file);
    // $req->validate([
    //   'imageFile' => 'required',
    //   'imageFile.*' => 'mimes:jpeg,jpg,png,pdf|max:2048'
    // ]);
    if($req->file) {
        $file = $req->file;
        $name = $file->getClientOriginalName();
        $file->move(public_path().'/uploads/', $name);
      //   // dd($req->file->getClientOriginalName());
      //   // foreach($req->file as $file)
      //   // {
      //   //     dd($file);
      //       // $name = $file->getClientOriginalName();
      //       // $file->move(public_path().'/uploads/', $name);  
      //       // $imgData[] = $name;  
      //   // }
      //   // $fileModal = new Image();
      //   // $fileModal->name = $name;
      //   // $fileModal->image_path = $name;
       
      //  if($fileModal->save()) {

          return true;
        // } else {
        //     return false;
        // }
    }
  }

}
