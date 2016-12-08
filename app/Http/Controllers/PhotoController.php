<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Photo;
use Illuminate\Support\Facades\DB;
use Auth;

class PhotoController extends Controller
{
    /*
    *  List all photos uploaded by user.
    *
    */
    public function show(Request $request)
    {
        if($request->filter) {
           $filter = $request->filter;
            // Insert data;
           $photo = DB::table('user_photos')->where('user', 'LIKE', '%'.$request->filter.'%')->orWhere('story', 'LIKE', '%'.$request->filter.'%')->orWhere('created_at', 'LIKE', '%'.$request->filter.'%')->paginate(12); 
        } else {
            $photo = Photo::paginate(12);
        }
        return view('photos/index', array('photos' => $photo));
    }

    /*
    * Delete photos uploaded by user.
    * param Photo id
    * Response 
    */
    public function deletePhoto($photoid)
    {
        $Photo = Photo::find($photoid);    
        $Photo->delete();    
    }

    /*
    * Delete photos uploaded by user.
    * param Photo id
    * Response 
    */
    public function uploadPhoto(Request $request)
    {
        // Get Current user id
        $user = Auth::User();     
        $userid = $user->name;
        $url = $request->userphoto; 
        # code...
        if($url!=null) {
                $video = new UserPhotos;
                $video->user = $userid;
                // $video->video   = $request->video;
                $video->url   = $file;
                $video->country = $request->country;
                $video->story = $request->story;
                // Insert data;
                $video->save();
        }
        return view('photos/upload');
    }    
    public function userphoto()
    {
        if(!empty($_FILES)){
          $errors= array();
          $file_name = $_FILES['video_input4']['name'][0];
          $file_size =$_FILES['video_input4']['size'][0];
          $file_tmp =$_FILES['video_input4']['tmp_name'][0];
          $file_type=$_FILES['video_input4']['type'][0];
          
          if($file_size > 2097152){
             $errors[]='File size must be excately 2 MB';
          }
          
          if(empty($errors)==true){
             move_uploaded_file($file_tmp,"public/product-logo/".$file_name);
          }else{
             print_r($errors);
          }
        // print_r($_FILES);
        $key = '<code to parse your image key>';
        $url = '<your server action to delete the file>';
        echo json_encode([
            'initialPreview' => [
                "<input type='text' value='http://localhost/angul/public/user-photos/".$file_name."' name='userphoto'><img src='http://localhost/angul/public/user-photos/".$file_name."' width = '200px'>"
            ],
            'initialPreviewConfig' => [
                ['caption' => "Sports-{$key}.jpg", 'size' => 627392, 'width' => '120px', 'url' => $url, 'key' => '1.jpg'],
            ],
            'append' => true
            ]);
       }
    }
}
