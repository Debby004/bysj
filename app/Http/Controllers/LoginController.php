<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/10
 * Time: 15:47
 */
namespace  App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\HTTP\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function info()
    {
        return view('Login/index');
    }
    public function reg()
    {
        $name = "123";
        return view('Login/reg',['name'=>$name]);
    }
    public function check(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $account =  $input_many['account'];

        $info = DB::table('user')->where('account', '=', $account)->get();
        foreach ($info as $key){
            $name=  $key->name ;
            $id=  $key->id ;
            $role=  $key->role ;
        }
        if (defined('$role')){
            var_dump("登陆失败2，正在返回上一页······");
            return false;
        }else{
            session()->put('role', $role);
            session()->put('name', $name);
            session()->put('id', $id);
            if($role == "master"){
                return redirect('/user/fa');
            }elseif ($role == "student"){
                return redirect('/user/fa');
            }elseif ($role == "teacher"){
                return redirect('/user/fa');
            }elseif ($role == "address"){
                return redirect('/user/fa');
            }else{
                var_dump("登陆失败，正在返回上一页······");
                return false;
            }

        }

    }
}


//

 

 