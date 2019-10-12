<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/11
 * Time: 14:03
 */
namespace  App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\Group;
use App\Model\Mission;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    public function index()
    {
        $id = Session::get('id');
        $name = Session::get('name');
        $role = Session::get('role');
        $user_list = DB::table('user')
            ->get();
        if($role=='master'){

            $message_list = DB::table('message')
                ->get();
        }else{

            $message_list = DB::table('message')->where('addressee_id',$id)
                ->get();
        }
        $message_list->transform(function ($item, $key) {
            $item->send_name = $key;
            $item->addressee_name = $key;
            return $item;
        });


        foreach ($message_list as $user) {
            $send_name =  $user->send_id;
            $addressee_name =  $user->addressee_id;
            $faculty= DB::table('user')->distinct()->where('id', $send_name)->get();
            foreach ($faculty as $userss) {
                $user->send_name = $userss->name;
            }
            $major = DB::table('user')->distinct()->where('id', $addressee_name)->get();
            foreach ($major as $userss1) {
                $user->addressee_name = $userss1->name;
            }

        }


        $name = Session::get('name');

        return view('Message/index',['name'=>$name,'role'=>$role,'message_list'=>$message_list,'user_list'=>$user_list]);
    }
    //发消息
    public function addMessage(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $rules = [
            'name' => 'required',
            'title' => 'required',
            'text' => 'required',

        ];
        $messages = [
            'descript.required'=>"请选择收件人",
            'title.required'=>"请输入消息标题",
            'text.required'=>"请输入消息内容",
        ];
        $this->validate($request, $rules, $messages);
        $send_id = Session::get('id');
        $date = date('Y-m-d');
        DB::insert('insert into `message` ( theme,text,send_id,addressee_id,create_time) values (?, ?, ?, ?, ?)', [  $input_many['title'], $input_many['text'], $send_id,$input_many['name'],$date]);
        return redirect()->back();
    }    //发消息
    public function delMessage($id){
        $id = trim($id,",");
        $num =  DB::delete("delete from message where id in "."(".$id.")");
        if($num){
            return redirect()->back();
        }else{
            return "删除失败";
        }
    }
}