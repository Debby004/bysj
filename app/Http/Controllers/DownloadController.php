<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/11
 * Time: 12:06
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;

class DownloadController extends Controller{
    function index(){
        $name = Session::get('name');
        $role = Session::get('role');
        return view('Common.top',['name'=>$name,'role'=>$role]);
    }
    function down($path){
        $file_path =  $_SERVER['DOCUMENT_ROOT']."/uploads/stuMission/";
        $pathToFile = $file_path.$path; 
        return response()->download($pathToFile);
    }
}