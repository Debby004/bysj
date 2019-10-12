<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/11
 * Time: 13:57
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\Address;
use App\Model\Faculty;
use App\Model\Group;
use Excel;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Tags\See;


class GroupController extends Controller{

    public $timestamps = true;
    public function index(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $group_name = isset($input_many['name'])?$input_many['name']:null;
        if($group_name == null){
            $result=  Group::distinct()->get();
        }else{
            $result = DB::table('group')
                ->where([['name', 'like', '%' . $group_name . '%']])
                ->orWhere([['account', 'like', '%' . $group_name . '%']])
                ->get();
        }
         $result->transform(function ($item, $key) {
            $item->creater_name = " ";
            $item->led_teacher_name = " ";
             $item->address_name = " ";
            return $item;
        });
        foreach ($result as $user) {
            $led_teacher_id =  $user->led_teacher_id;
            $address_id =  $user->address_id;
            $creater_id =  $user->creater_id;
            $address_name = DB::table('address')->distinct()->where('id', $address_id)->get();
            $creater = DB::table('user')->distinct()->where('id', $creater_id)->get();
            $led_teacher_name = DB::table('user')->distinct()->where('id', $led_teacher_id)->get();
            foreach ($creater as $userss) {
                $user->creater_name = $userss->name;
            }
            foreach ($address_name as $userss) {
                $user->address_name = $userss->name;
            }foreach ($led_teacher_name as $usersss) {
                $user->led_teacher_name = $usersss->name;
            }
        }
        $name = Session::get('name');
        $role = Session::get('role');
        return view('Group/index',['role'=>$role,'name'=>$name,'group'=>$result]);
    }
    //教师模块显示自己的实习组
    public function groupTea(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $group_name = isset($input_many['name'])?$input_many['name']:null;
        $id = Session::get('id');
        if($group_name == null){
            $result=  Group::where('led_teacher_id',$id)->get();
        }else{
            $result = DB::table('group')
                ->where([['name', 'like', '%' . $group_name . '%'],['led_teacher_id','=',$id]])
                ->orWhere([['account', 'like', '%' . $group_name . '%']])
                ->get();
        }
        $result->transform(function ($item, $key) {
            $item->creater_name = " ";
            $item->led_teacher_name = " ";
            $item->address_name = " ";
            return $item;
        });
        foreach ($result as $user) {
            $led_teacher_id =  $user->led_teacher_id;
            $address_id =  $user->address_id;
            $creater_id =  $user->creater_id;
            $address_name = DB::table('address')->distinct()->where('id', $address_id)->get();
            $creater = DB::table('user')->distinct()->where('id', $creater_id)->get();
            $led_teacher_name = DB::table('user')->distinct()->where('id', $led_teacher_id)->get();
            foreach ($creater as $userss) {
                $user->creater_name = $userss->name;
            }
            foreach ($address_name as $userss) {
                $user->address_name = $userss->name;
            }foreach ($led_teacher_name as $usersss) {
                $user->led_teacher_name = $usersss->name;
            }
        }
        $name = Session::get('name');
        $role = Session::get('role');
        return view('Group/index',['role'=>$role,'name'=>$name,'group'=>$result]);
    }
    public function addGroup(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $rules = [
            'account' => 'required|min:4|max:255|unique:group,account,' . request('id'),
            'name' => 'required|min:4|max:255|unique:group,account,' . request('id'),
            'limit_count' => 'required',
            
        ];
        $messages = [
            'account.required'=>"请输入实习小组编号",
            'account.unique'=>"实习小组编号已经存在，请重新设置实习小组编号",
            'name.required'=>"请输入实习小组名称",
            'name.unique'=>"实习小组名称已经存在，请重新设置实习小组名称",
            'limit_count.required'=>"请输入小组限报人数",
        ];
        $this->validate($request, $rules, $messages);
        $user_id = Session::get('id');
        DB::insert('insert into `group` ( account,name,limit_count,start_time,end_time,creater_id,type) values (?, ?, ?, ?,?, ?, ?)', [  $input_many['account'], $input_many['name'], $input_many['limit_count'], $input_many['start_time'], $input_many['end_time'],$user_id,$input_many['type']]);
        return redirect()->back();
    }
    //删除实习小组
    public function delGroup($id){
        $id = trim($id,",");
        $num =  DB::delete("delete from `group` where id in "."(".$id.")");
        if($num){
            return redirect()->back();
        }else{
            return "删除失败";
        }
    }
    //修改实习小组信息
    public function update(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $this->validate($request, [
        ]);
        $id =$input_many['up_id'];
        $name=$input_many['up_name'];
        $account=$input_many['up_account'];
        $type=$input_many['up_type'];
        $limit_count=$input_many['up_limit_count'];
        $start_time=$input_many['up_start_time'];
        $end_time=$input_many['up_end_time'];
        DB::update('update `group` set name = ? , account = ? , type = ? , start_time = ? , end_time = ? , limit_count = ? where id = ?',[$name,$account,$type,$start_time,$end_time,$limit_count,$id]);
        return redirect()->back();
    }
    //实习组添加老师学生实习地点
    public function updateTeaStu($id){
        $id = trim($id,",");
        $group = DB::table('group')->distinct()->where('id', $id)->get();
        $address = DB::table('address')->get();
        $tea = DB::table('user')->distinct()->where('role', 'teacher')->get();
        $stu = DB::table('user')->distinct()->where('role', 'student')->get();


        $mission =  DB::table('mission')->get();
        $mission_ids = "";
        foreach($mission as $key => $value){
            $mission_group_id = $value->group_id;
            $mission_group_id = explode(',',$mission_group_id);
            if(in_array($id,$mission_group_id)){
                $mission_ids .= $value->id;
                $mission_ids .= ",";
            }
        }
        
        $mission_ids = trim($mission_ids,',');
        $mission_ids = explode(',',$mission_ids);
        $groupMission =  DB::table('mission')->whereIn('id',$mission_ids)->get();
        //实习小组详细信息

        $group->transform(function ($item, $key) {
            $item->creater_name = " ";
            $item->led_teacher_name = " ";
            $item->address_name = " ";
            $item->address_address = " ";
            return $item;
        });
        foreach ($group as $user) {
            $led_teacher_id =  $user->led_teacher_id;
            $address_id =  $user->address_id;
            $creater_id =  $user->creater_id;
            $address_name = DB::table('address')->distinct()->where('id', $address_id)->get();
            $creater = DB::table('user')->distinct()->where('id', $creater_id)->get();
            $led_teacher_name = DB::table('user')->distinct()->where('id', $led_teacher_id)->get();
            foreach ($creater as $userss) {
                $user->creater_name = $userss->name;
            }
            foreach ($address_name as $userss) {
                $user->address_name = $userss->name;
                $user->address_address.= $userss->provice.=$userss->city.=$userss->address;;
            }foreach ($led_teacher_name as $usersss) {
                $user->led_teacher_name = $usersss->name;
            }
        }

        $stu->transform(function ($item, $key) {
            $item->faculty_name = " ";
            $item->major_name = " ";
            return $item;
        });
        foreach ($stu as $key) {
            $faculty_id =  $key->faculty_id;
            $major_id =  $key->major_id;
            $fa =  DB::table('faculty')->where([['id',$faculty_id]])->get();
                foreach ($fa as $k => $v){
                    $key->faculty_name = $v->name;
            }
            $fa1 =  DB::table('faculty')->where([['id',$major_id]])->get();
                foreach ($fa1 as $k1 => $v1){
                    $key->major_name = $v1->name;
            }

        }
        $tea->transform(function ($item, $key) {
            $item->faculty_name = " ";
            $item->major_name = " ";
            return $item;
        });
        foreach ($tea as $key) {
            $faculty_id =  $key->faculty_id;
            $major_id =  $key->major_id;
            $fa =  DB::table('faculty')->where([['id',$faculty_id]])->get();
                foreach ($fa as $k => $v){
                    $key->faculty_name = $v->name;
            }
            $fa1 =  DB::table('faculty')->where([['id',$major_id]])->get();
                foreach ($fa1 as $k1 => $v1){
                    $key->major_name = $v1->name;
            }

        }

        foreach($group as $key => $value){
            $stu_id = $value->stu_id;
            $tea_id = $value->led_teacher_id;
        }
        $stu_id.=",";
        $stu_id.=$tea_id;
        $stu_id = explode(',',$stu_id);
        $member = DB::table('user')->whereIn('id',$stu_id)->orderBy('role')->get();
        $member->transform(function ($item, $key) {
            $item->faculty_name = " ";
            $item->major_name = " ";
            return $item;
        });
        foreach ($member as $key) {
            $faculty_id =  $key->faculty_id;
            $major_id =  $key->major_id;
            $fa =  DB::table('faculty')->where([['id',$faculty_id]])->get();
            foreach ($fa as $k => $v){
                $key->faculty_name = $v->name;
            }
            $fa1 =  DB::table('faculty')->where([['id',$major_id]])->get();
            foreach ($fa1 as $k1 => $v1){
                $key->major_name = $v1->name;
            }

        }
        $name = Session::get('name');
        $role = Session::get('role'); 
       return view('Group/update',['name'=>$name,'role'=>$role,'group'=>$group,'groupMission'=>$groupMission,'stu'=>$stu,'tea'=>$tea,'member'=>$member,'address'=>$address]);
    }
    public function addTea($id,$groupId){
        $id = trim($id,",");
        $groupId = trim($groupId,",");

        DB::update('update `group` set led_teacher_id = ? where id = ?',[$id,$groupId]);
        $group = DB::table('group')->distinct()->where('id', $id)->get();
        $tea = DB::table('user')->distinct()->where('role', 'teacher')->get();
        $stu = DB::table('user')->distinct()->where('role', 'student')->get();
        $name = Session::get('name');
        $role = Session::get('role');
        return redirect('/group/');
    }
    public function addAddress($id,$groupId){
        $id = trim($id,",");
        $groupId = trim($groupId,",");

        DB::update('update `group` set address_id = ? where id = ?',[$id,$groupId]);
        $group = DB::table('group')->distinct()->where('id', $id)->get();
        $tea = DB::table('user')->distinct()->where('role', 'teacher')->get();
        $stu = DB::table('user')->distinct()->where('role', 'student')->get();
        $name = Session::get('name');
        $role = Session::get('role');
        return redirect('/group/');
    }
    public function addStu($id,$groupId){
        $id = trim($id,",");
        $groupId = trim($groupId,",");
        //筛选出原来的学生id
        $group = DB::table('group')->distinct()->where('id', $groupId)->get();

        if ($group->count()) {

        }else{
            foreach($group as $kwy => $value){
            $stu_id = $value->stu_id;
          }
            foreach( $id as $k=>$v) {
                foreach( $stu_id as $k1=>$v1) {

                    if($v == $v1) unset($stu_id[$k1]);
                }
            }
            $id .=",";
            $id.=$stu_id;

        }

        DB::update('update `group` set stu_id = ? where id = ?',[$id,$groupId]);
        $group = DB::table('group')->distinct()->where('id', $id)->get();
        $tea = DB::table('user')->distinct()->where('role', 'teacher')->get();
        $stu = DB::table('user')->distinct()->where('role', 'student')->get();
        $name = Session::get('name');
        $role = Session::get('role');
        return redirect('/group/');
    }
    public function delGroupUser($id,$groupId){
        $id = trim($id,",");
        $id = explode(',',$id);
        $groupId = trim($groupId,",");
        var_dump($id);
        //筛选出原来的学生id
        $group = DB::table('group')->distinct()->where('id', $groupId)->get();
        foreach($group as $kwy => $value){
            $stu_id = $value->stu_id;
        }
        $stu_id = explode(',',$stu_id);
        foreach( $id as $k=>$v) {
            foreach( $stu_id as $k1=>$v1) {

                if($v == $v1) unset($stu_id[$k1]);
            }
        }
        $groupId = implode(",", $stu_id);
        DB::update('update `group` set stu_id = ? where id = ?',[$stu_id,$groupId]);

        return redirect('/group/');
    }

    public  function stu(){
        $name = Session::get('name');
        $role = Session::get('role');
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
         return view('group.stu',['role'=>$role,'name'=>$name,'result'=>$result]);

    }

}