<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/11
 * Time: 12:50
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\Group;
use App\Model\Mission;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
class SettingController extends Controller{
    public function index(){
        $name = Session::get('name');
        $role = Session::get('role');
        return view('Setting.index',['name'=>$name,'role'=>$role]);
}
    //学生上传文件
    public function add(Request $request){
        $input_many=$request->except(['_token']);
        $user_id = Session::get('id');
        //获取到临时文件
        $file=$_FILES['file'];
        //获取文件名
        $fileName=$file['name'];
        //移动文件到当前目录
        $file_namess = "timg.jpg";
        $filePath= $_SERVER['DOCUMENT_ROOT']."/uploads/stuMission/".$file_namess;
        move_uploaded_file($file['tmp_name'],$filePath);
        $file_path =  $_SERVER['DOCUMENT_ROOT']."/uploads/stuMission/";


            DB::update('update mission_detail set text = ? ,path = ? ,file_name = ? where mission_id = ? ',[$input_many['text'],$file_path,$fileName,'999900']);

        return redirect()->back();
    }
}