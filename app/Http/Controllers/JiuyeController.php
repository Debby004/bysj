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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
class JiuyeController extends Controller{
    public function index(){
        $name = Session::get('name');
        $role = Session::get('role');
        $id = Session::get('id');

        $result = DB::table('user')->where('id',$id)
            ->get();
        return view('jiuye.index',['name'=>$name,'role'=>$role,'result'=>$result]);
    }
}