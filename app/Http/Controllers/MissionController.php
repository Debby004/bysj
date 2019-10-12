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
class MissionController extends Controller
{
    public function index(Request $request)
    {
        $input_many=$request->except(['_token','create_time']);
        $group_name = isset($input_many['name'])?$input_many['name']:null;
        if($group_name == null){
            $result=  Mission::distinct()->get();
        }else{
            $result = DB::table('mission')
                ->where([['name', 'like', '%' . $group_name . '%']]) 
                ->get();
        }
        $result->transform(function ($item, $key) {
            $item->creater_name = $key;
            return $item;
        });
        foreach ($result as $user) {
            $creater_id =  $user->creater_id;
            $creater = DB::table('user')->distinct()->where('id', $creater_id)->get();
            foreach ($creater as $userss) {
                $user->creater_name = $userss->name;
            }

        }

        $group=  Group::distinct()->get();
        $name = Session::get('name');
        $role = Session::get('role');
        return view('Mission/index',['name'=>$name,'role'=>$role,'result'=>$result,'group'=>$group]);
    }

    public function addMission(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $rules = [
            'name' => 'required|min:4|max:255,account,' . request('id'),
            'num' => 'required',
            'descript' => 'required',

        ];
        $messages = [
            'descript.required'=>"请输入任务详细描述",
            'name.required'=>"请输入任务名",
            'num.required'=>"请输入任务数量",
        ];
        $this->validate($request, $rules, $messages);
        $user_id = Session::get('id');
        $date = date('Y-m-d');
        DB::insert('insert into `mission` ( name,num,descript,creater_id,created_at) values (?, ?, ?, ?, ?)', [  $input_many['name'], $input_many['num'], $input_many['descript'], $user_id,$date]);
        return redirect()->back();
    }
    public function devMission($groupId,$id)
    {

        $id = trim($id, ",");
        $groupId = trim($groupId, ",");
        //筛选出原来的实习组id
        $group = DB::table('mission')->distinct()->where('id', $id)->get();
        foreach ($group as $kwy => $value) {
            $group_id = $value->group_id;
        }
        if ($group_id == null) {
            $groupId = $groupId;
        } else {
            $groupId = explode(',', $groupId);
            $group_id = explode(',', $group_id);
            foreach ($groupId as $k => $v) {
                foreach ($group_id as $k1 => $v1) {

                    if ($v == $v1) unset($group_id[$k1]);
                }
            }
            $groupId = implode(",", $groupId);
            $group_id = implode(",", $group_id);
            $groupId.=",";
            $groupId.=$group_id;

         }

        DB::update('update `mission` set group_id = ? where id = ?',[$groupId,$id]);


       return redirect()->back();
    }
//学生查看自己的实习任务
    public  function stu(){
        $name = Session::get('name');
        $role = Session::get('role');
        //先找出学生所在的实习小组
        $id = Session::get('id');
        $group =  DB::table('group')->get();
        $ids = "";
        foreach($group as $key => $value){

            $stu_id = $value->stu_id;
            $stu_id = explode(',',$stu_id);
            if(in_array($id,$stu_id)){
                $ids .= $value->id;
                $ids .= ",";
            }
        }
        $ids = trim($ids,',');
        $arr = explode(',',$ids);
        $result =  DB::table('group')->whereIn('id',$arr)->get();
        //再根据学生所在的实习小组查找出实习任务
        foreach($result as $key => $value){
            $group_id = $value->id;
        }

        $mission =  DB::table('mission')->get();
        $mission_ids = "";
        foreach($mission as $key => $value){

            $mission_group_id = $value->group_id;
            $mission_group_id = explode(',',$mission_group_id);
            if(in_array($group_id,$mission_group_id)){
                $mission_ids .= $value->id;
                $mission_ids .= ",";
            }
        }
        $mission_ids = trim($mission_ids,',');
        $mission_ids = explode(',',$mission_ids);
        $mission_result =  DB::table('mission')->whereIn('id',$mission_ids)->get();

        $mission_result->transform(function ($item, $key) {
            $item->file_name = $key;
            $item->path = $key; 
            return $item;
        });
        foreach ($mission_result as $key) {
            $mission_id =  $key->id;
            $mission_detail =  DB::table('mission_detail')->where([['mission_id',$mission_id],['stu_id',$id]])->get();
            if ($mission_detail->count()) {
                foreach ($mission_detail as $k => $v){
                    $key->file_name = $v->file_name;
                    $key->path = $v->path;
                 }
            }else{
                $key->file_name = " ";
                $key->path = " ";

            }

        }

        return view('mission.stu',['role'=>$role,'name'=>$name,'result'=>$mission_result]);
    }
//老师查找出学生上传的任务，并打分
    public  function fenshu(Request $request){
        $name = Session::get('name');
        $role = Session::get('role');
        $input_many=$request->except(['_token','create_time']);

        $stuid =$input_many['stuid'];
        //先找出老师所在的实习小组
        $id = Session::get('id');

        $result =  DB::table('group')->where('led_teacher_id',$id)->get();
        if ($result->count()) {
            //再根据老师所在的实习小组查找出实习任务
            foreach($result as $key => $value){
                $group_id = $value->id;
            }

            $mission =  DB::table('mission')->get();
            $mission_ids = "";
            foreach($mission as $key => $value){

                $mission_group_id = $value->group_id;
                $mission_group_id = explode(',',$mission_group_id);
                if(in_array($group_id,$mission_group_id)){
                    $mission_ids .= $value->id;
                    $mission_ids .= ",";
                }
            }
            $mission_ids = trim($mission_ids,',');
            $mission_ids = explode(',',$mission_ids);
            $mission_result =  DB::table('mission')->whereIn('id',$mission_ids)->get();

            $mission_result->transform(function ($item, $key) {
                $item->file_name = " ";
                $item->path = " ";
                $item->stu_name = " ";
                $item->stu_account = " ";
                $item->stu_id = " ";
                $item->miss_det_id = " ";
                return $item;
            });
            foreach ($mission_result as $key) {
                $mission_id =  $key->id;
                $mission_detail =  DB::table('mission_detail')->where([['mission_id',$mission_id],['stu_id',$stuid]])->get();
                $stu =  DB::table('user')->where('id',$stuid)->get();
                foreach ($stu as $k1 =>$v1){
                    $key->stu_name = $v1->name;
                    $key->stu_id = $v1->id;
                    $key->stu_account = $v1->account;
                }
                if ($mission_detail->count()) {
                    foreach ($mission_detail as $k => $v){
                        $key->miss_det_id = $v->id;
                        $key->file_name = $v->file_name;
                        $key->path = $v->path;
                    }

                }else{

                }

            }
        }else{ 
            $mission_result = array();
        }

        $fenshu =  DB::table('mission_detail')->where([['mission_id','888888'],['stu_id',$stuid]])->get();
          if($fenshu->count()){
              foreach ($fenshu as $kkk){
                  $stu_fenshu = $kkk->fenshu;
              }
          }else{
              $stu_fenshu = " ";
          }

        return view('mission.tea',['role'=>$role,'name'=>$name,'result'=>$mission_result,'stu_fenshu'=>$stu_fenshu]);
    }

    //学生上传文件
    public function stuadd(Request $request){
        $input_many=$request->except(['_token']);
        $mission_id=  $input_many['id'];
        $user_id = Session::get('id');
        //获取到临时文件
        $file=$_FILES['file'];
        //获取文件名
         $fileName=$file['name'];
        //移动文件到当前目录
        $filePath= $_SERVER['DOCUMENT_ROOT']."/uploads/stuMission/".$fileName;
        move_uploaded_file($file['tmp_name'],$filePath);
        $file_path =  $_SERVER['DOCUMENT_ROOT']."/uploads/stuMission/";

        $mission_detail =  DB::table('mission_detail')->where([['mission_id',$mission_id],['stu_id',$user_id]])->get();

        foreach ($mission_detail as $key =>$value){
            $mission_det_id = $value->id;
        }
        if ($mission_detail->count()) {
            DB::update('update mission_detail set path = ? ,file_name = ? where id = ? ',[$file_path,$fileName,$mission_det_id]);
        }else{
            DB::insert('insert into mission_detail (mission_id,stu_id,path,file_name) values (?, ?, ?, ?)', [ $mission_id,$user_id,$file_path,$fileName]);
        }
        return redirect()->back();
    }
    //老师打分
    public function pingfen(Request $request){
        $input_many=$request->except(['_token']);
        $user_id = Session::get('id');
        DB::insert('insert into mission_detail (mission_id,text,stu_id,fenshu) values (?, ?,?, ?)', [ '888888',$user_id,$input_many['stu_id'],$input_many['fenshu']]);
        return redirect()->back();

    }    //实习基地老师打分
    public function addressPingfen(Request $request){
        $input_many=$request->except(['_token']);
        $user_id = Session::get('id');

        DB::insert('insert into mission_detail (mission_id,text,stu_id,fenshu) values (?, ?,?, ?)', [ '999999',$user_id,$input_many['stu_id'],$input_many['fenshu']]);
        return redirect()->back();

    }
}