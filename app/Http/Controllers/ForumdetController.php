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
use App\Model\Address;
use App\Model\Faculty;
use Excel;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;


class ForumdetController extends Controller{
    public function index(){

        $name = Session::get('name');
        $role = Session::get('role');
        $group_list = DB::table('group')->get();
        $news_list = DB::table('news')->get();
        $forum_list = DB::table('forum')->get();
        $set_list = DB::table('mission_detail')->where('mission_id','999900')->get();
        return view('forumdet.index',['name'=>$name,'role'=>$role,'group_list'=>$group_list,'news_list'=>$news_list,'forum_list'=>$forum_list,'set_list'=>$set_list]);
    }
    public function zhaopin(){

        $name = Session::get('name');
        $role = Session::get('role');
        return view('Personal.zhaopin',['name'=>$name,'role'=>$role]);
    }
    public function fbzhaopin(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $user_id = Session::get('id');
        $rules = [
            'text' => 'required',

        ];
        $messages = [
            'text.required' => '请填写招聘简章！',
        ];
        $this->validate($request, $rules, $messages);
        $date = date('Y-m-d');
        DB::insert('insert into forum_detail (forum_id,text,send_id,create_time) values (?, ?, ?, ?)', ['999999',$input_many['text'],$user_id,$date]);
        return redirect()->back();
    }
    public function addForum(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $user_id = Session::get('id');
        $rules = [
            'text' => 'required',

        ];
        $messages = [
            'text.required' => '请填写帖子内容！',
        ];
        $this->validate($request, $rules, $messages);
        $date = date('Y-m-d');
        DB::insert('insert into forum_detail (forum_id,text,send_id,create_time) values (?, ?, ?, ?)', [$input_many['forum_id'],$input_many['text'],$user_id,$date]);
        return redirect()->back();
    }
    public function replyForum(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $user_id = Session::get('id');
        $rules = [
            'text' => 'required',
        ];
        $messages = [
            'text.required' => '请填写回复内容！',
        ];
        $this->validate($request, $rules, $messages);
        $date = date('Y-m-d');
        DB::insert('insert into forum_detail (theme_id,text,send_id,create_time) values (?, ?, ?, ?)', [$input_many['theme_id'],$input_many['text'],$user_id,$date]);
        return redirect()->back();
    }
    public function det($id){
        $name = Session::get('name');
        $role = Session::get('role');
        $forum_list = DB::table('forum_detail')->where('forum_id',$id)->get();
        $forum = DB::table('forum')->where('id',$id)->get();
        $forum_list->transform(function ($item, $key) {
            $item->creater_name = $key;
            return $item;
        });
        foreach ($forum_list as $user) {
            $creater_id = $user->send_id;
            $create_name = DB::table('user')->distinct()->where('id', $creater_id)->get();
            foreach ($create_name as $userss) {
                $user->creater_name = $userss->name;
            }
        }
        $set_list = DB::table('mission_detail')->where('mission_id','999900')->get();
        return view('Forumdet.det',['name'=>$name,'role'=>$role,'result'=>$forum_list,'forum'=>$forum,'set_list'=>$set_list]);
    }
    public function reply($id){
        $name = Session::get('name');
        $role = Session::get('role');
        $forum= DB::table('forum_detail')->where('id',$id)->get();
        foreach ($forum as $item){
            $forum_id = $item->forum_id;
        }
        $forum = DB::table('forum')->where('id',$forum_id)->get();
        $forum_detail = DB::table('forum_detail')->where('theme_id',$id)->orwhere('id',$id)->get();

        $forum_detail->transform(function ($item, $key) {
            $item->create_name = " ";
            $item->zuichu_id = " ";
            return $item;
        });
        foreach ($forum_detail as $user) {
            $creater_id = $user->send_id;
            $create_name = DB::table('user')->distinct()->where('id', $creater_id)->get();
            foreach ($create_name as $userss) {
                $user->create_name = $userss->name;
                $user->zuichu_id = $id;
            }
        }
        $set_list = DB::table('mission_detail')->where('mission_id','999900')->get();
        return view('Forumdet.reply',['name'=>$name,'role'=>$role,'result'=>$forum_detail,'forum'=>$forum,'set_list'=>$set_list]);
    }

}