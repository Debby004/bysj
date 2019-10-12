<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/11
 * Time: 14:00
 */
namespace  App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
class CountController extends Controller
{
    public function index()
    {

        $result =  DB::table('user')->where('role','student')->get();
        $result->transform(function ($item, $key) {
            $item->faculty_name = " ";
            $item->major_name = " ";
            $item->fenshu_add = " ";
            $item->fenshu_led = " ";
            $item->zongfen = " ";
            $item->address_name = " ";
            $item->zongfen = " ";
            return $item;
        });
        foreach ($result as $user) {
            $faculty_id =  $user->faculty_id;
            $major_id =  $user->major_id;
            $stu_id = $user->id;
            $faculty= DB::table('faculty')->distinct()->where('id', $faculty_id)->get();
            foreach ($faculty as $userss) {
                $user->faculty_name = $userss->name;
            }
            $major = DB::table('faculty')->distinct()->where('id', $major_id)->get();
            foreach ($major as $userss) {
                $user->major_name = $userss->name;
            }
            $mission_address = DB::table('mission_detail')->where([['mission_id', '999999'],['stu_id',$stu_id]])->get();
            foreach ($mission_address as $userss22) {
                $user->fenshu_add = $userss22->fenshu;
            }
          $mission_led = DB::table('mission_detail')->where([['mission_id', '888888'],['stu_id',$stu_id]])->get();
            foreach ($mission_led as $userss212) {
                $user->fenshu_led = $userss212->fenshu;
            }
            $address = DB::table('address')->where('jy',$stu_id)->get();
            foreach ($address as $userss2112) {
                $user->address_name = $userss2112->name;
            }
            $total = (int)$user->fenshu_add + (int)$user->fenshu_led;
            $num = 2;
            $user->zongfen = $total/$num;
        }
        $name = Session::get('name');
        $role = Session::get('role');
        return view('Count/index',['name'=>$name,'role'=>$role,'result'=>$result]);
    }
}