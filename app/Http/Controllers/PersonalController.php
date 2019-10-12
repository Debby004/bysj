<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/11
 * Time: 14:13
 */
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Model\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
class PersonalController extends Controller{
    public function index(){
        $name = Session::get('name');
        $role = Session::get('role');
        $id = Session::get('id');
        $result = User::where('id',$id)->get();
        return view('Personal.index',['name'=>$name,'role'=>$role,'result'=>$result]);
    }
}