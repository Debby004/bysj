<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/11
 * Time: 14:13
 */
namespace  App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\Group;
use App\Model\Mission;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
class NewsController extends Controller{
    public function index(){
        $name = Session::get('name');
        $role = Session::get('role');
        $user_list = DB::table('user')->get();
        $news_list = DB::table('news')->get();
        return view('news.index',['name'=>$name,'role'=>$role,'news_list'=>$news_list,'user_list'=>$user_list]);
    }
    //发消息
    public function addNews(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $rules = [
            'title' => 'required',
            'text' => 'required',

        ];
        $messages = [
            'title.required'=>"请输入公告标题",
            'text.required'=>"请输入公告内容",
        ];
        $this->validate($request, $rules, $messages);
        $user_id = Session::get('id');
        $date = date('Y-m-d');
        DB::insert('insert into `news` ( title,text,creater_id,create_time) values (?, ?, ?,?)', [  $input_many['title'],$input_many['text'],$user_id,$date]);
        return redirect()->back();
    }    //发消息
    public function delNews($id){
        $id = trim($id,",");
        $num =  DB::delete("delete from news where id in "."(".$id.")");
        if($num){
            return redirect()->back();
        }else{
            return "删除失败";
        }
    }
}