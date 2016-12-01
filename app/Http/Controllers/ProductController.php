<?php
/**
 * @package    User Controller
 *
 * @copyright  2016 metamorphosis.tv
 * @author     Ajith, sparksupport.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    /**
     * List video stations list.
     *
     * @return \Illuminate\Http\Response
     */

    public function show()
    {
        // Get Video stations list
        $stations = DB::table('products')->select('*')
        ->where([
            ['products.station_type', '=', 'video'],
            ])
        ->paginate(20);
        return view('products/index', array('stations' => $stations));
    }

    /**
     * Get video stations list.
     *
     * @return \Illuminate\Http\Response
     */

    public function detail($streamid)
    {
        // Get Video stations list
        $station = DB::table('products')->select('*')
        ->where([
            ['products.id', '=', $streamid],
            ])
        ->get();
        return view('products/detail', array('station' => $station));
    }
    

    /**
     * Create Video/Radio Stations.
     *
     * @return null
     */

    public function createProduct(Request $request) {
        if( isset($request->video) && $request->video == 0) {
            foreach ($request->video_station_name as $key => $value) {
                if(isset($request->video_id[$key])) {
                    $product = Product::find($request->video_id[$key]);
                } else {
                    $product = new Product;
                }
                $product->station_instance = $request->video_station_stream[$key];
                $product->station_name = $value;
                if(isset($request->video_logo[$key])) {
                    $product->station_logo = $request->video_logo[$key];
                }
                $product->station_type = 'video';
                $product->company_id = $request->company_id;
                $product->save();
            }
        }
        if( isset($request->radio) && $request->radio == 0) {
            foreach ($request->radio_station_name as $key => $value) {
                if(isset($request->radio_id[$key])) {
                    $product = Product::find($request->radio_id[$key]);
                } else {
                    $product = new Product;
                }
                $product->station_name = $value;
                $product->station_instance = $request->radio_station_stream[$key];
                if(isset($request->audio_logo[$key])) {
                    $product->station_logo = $request->audio_logo[$key];
                }
                $product->station_type = 'radio';
                $product->company_id = $request->company_id;
                $product->save();
            }
        }
    }

    /**
     * Insert/Update video stations logo.
     *
     * @return null
     */

    public function videoLogo() {
       if(isset($_FILES)){
          $errors= array();
          $file_name = $_FILES['video_input4']['name'][0];
          $file_size = $_FILES['video_input4']['size'][0];
          $file_tmp  = $_FILES['video_input4']['tmp_name'][0];
          $file_type = $_FILES['video_input4']['type'][0];
          
          if($file_size > 2097152){
             $errors[]='File size must be excately 2 MB';
          }
          
          if(empty($errors)==true){
             move_uploaded_file($file_tmp,"public/product-logo/".$file_name);
          }else{
             print_r($errors);
          }
       }
        // print_r($_FILES);
        $key = '<code to parse your image key>';
        $url = '<your server action to delete the file>';
        echo json_encode([
            'initialPreview' => [
                "<input type='hidden' value=".url('/')."/public/product-logo/".$file_name." name='video_logo[]'><img src=".url('/')."/public/product-logo/".$file_name." width = '200px'>"
            ],
            'initialPreviewConfig' => [
                ['caption' => "Sports-{$key}.jpg", 'size' => 627392, 'width' => '120px', 'url' => $url, 'key' => '1.jpg'],
            ],
            'append' => false
            ]);
    }

    /**
     * Insert/Update video stations logo.
     *
     * @return null
     */

    public function streamLogo($streamid) {
       if(isset($_FILES)){
          $errors= array();
          $file_name = $_FILES['input7']['name'][0];
          $file_size = $_FILES['input7']['size'][0];
          $file_tmp  = $_FILES['input7']['tmp_name'][0];
          $file_type = $_FILES['input7']['type'][0];
          
          if($file_size > 2097152){
             $errors[]='File size must be excately 2 MB';
          }
          
          if(empty($errors)==true){
             move_uploaded_file($file_tmp,"public/product-logo/".$file_name);
          }else{
             print_r($errors);
          }
       }
        // print_r($_FILES);
        $key = '<code to parse your image key>';
        $url = '<your server action to delete the file>';
        echo json_encode([
            'initialPreview' => [
                "<input type='hidden' value=".url('/')."/public/product-logo/".$file_name." name='video_logo[]'><img src=".url('/')."/public/product-logo/".$file_name." width = '200px'>"
            ],
            'initialPreviewConfig' => [
                ['caption' => "Sports-{$key}.jpg", 'size' => 627392, 'width' => '120px', 'url' => $url, 'key' => '1.jpg'],
            ],
            'append' => false
            ]);
        $stream['station_logo'] = url('/').'/public/product-logo/'.$file_name;
        // Insert data;
        DB::table('products')->where('id', $streamid)->update($stream);
    }  

    /**
     * Insert/Update audio stations logo.
     *
     * @return null
     */

    public function audioLogo() {
       if(isset($_FILES)){
          $errors= array();
          $file_name = $_FILES['radio_input5']['name'][0];
          $file_size = $_FILES['radio_input5']['size'][0];
          $file_tmp  = $_FILES['radio_input5']['tmp_name'][0];
          $file_type = $_FILES['radio_input5']['type'][0];
          
          if($file_size > 2097152){
             $errors[]='File size must be excately 2 MB';
          }
          
          if(empty($errors)==true){
             move_uploaded_file($file_tmp,"public/product-logo/".$file_name);
          }else{
             print_r($errors);
          }
       }
        $key = '<code to parse your image key>';
        $url = '<your server action to delete the file>';
        echo json_encode([
            'initialPreview' => [
                "<input type='hidden' value=".url('/')."/public/product-logo/".$file_name." name='audio_logo[]'><img src=".url('/')."/public/product-logo/".$file_name." width = '200px'>"
            ],
            'initialPreviewConfig' => [
                ['caption' => "Sports-{$key}.jpg", 'size' => 627392, 'width' => '120px', 'url' => $url, 'key' => '1.jpg'],
            ],
            'append' => false
            ]);
    }

    /**
     * Update Stations.
     *
     * @return \Illuminate\Http\Response
     */

    public function updateProduct(Request $request)
    {
        $stream[$request->field] = $request->value;
        // Insert data;
        DB::table('products')->where('id', $request->streamid)->update($stream);
    }        
}
