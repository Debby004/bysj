<?php
/**
 * Created by PhpStorm.
 * User: Administrator
* Date: 2018/12/11
* Time: 11:57
*/
namespace  App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\User;
use App\Model\Address;
use App\Model\Faculty;
use Excel;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

//use Carbon\Carbon;
//use Illuminate\Pagination\Paginator;
//use App\Http\Controllers\Controller;
//use Illuminate\Database\Migrations\Migration;


class UserController extends Controller
{
    public $timestamps = true;
    /**
     * 构造函数
     * @var array
     */
    
    function __construct(Request $request) {
        parent::__construct();


    }

    public function index()
    {
        return view('User.index');
    }

    //院系专业首页
    public function faculty(Request $request){
        $name = Session::get('name');
        $role = Session::get('role');
        $id = Session::get('id');
        $info = DB::table('user')->where('id', '=', $id)->get();
        $input_many=$request->except(['_token','create_time']);
        $faculty_id =  isset($input_many['faculty_id'])?$input_many['faculty_id']:0;
        $sMajor = isset($input_many['sMajor'])?$input_many['sMajor']:0;
        if ($faculty_id==0&&$sMajor==""){
            $faculty =  DB::table('faculty')->get();
        }else {
            if ($faculty_id == 0) {
                $faculty = DB::table('faculty')
                    ->where('name', 'like', '%' . $sMajor . '%')->get();
            }elseif($sMajor==""){
                $faculty = DB::table('faculty')
                    ->where('id', '=', $faculty_id)
                    ->orWhere('faculty_id', '=', $faculty_id)
                    ->get();
            }else{
                $faculty = DB::table('faculty')
                    ->where([['name', 'like', '%' . $sMajor . '%'],['faculty_id', '=', $faculty_id]])
                    ->get();

            }
        }
        $multiplied = $faculty->transform(function ($item, $key) {
            $item->faculty_name = $key;
            $item->create_name = $key;
            return $item;
        });

        foreach ($faculty as $user) {
            $faculty_id =  $user->faculty_id;
            if($faculty_id==''){
                $user->faculty_name = $user->name;
            }else{
                $users = DB::table('faculty')->distinct()->where('id', $faculty_id)->get();
                foreach ($users as $userss) {
                    $user->faculty_name = $userss->name;
                }
            }
            $creater_id = $user->create_id;
            $creater_name =  DB::table('user')->where('id',$creater_id)->get();
            foreach ($creater_name as $k => $v){
                $user->create_name = $v->name;
            }
        }
        // 从院系专业表中晒选出院系
        $faculty =  Faculty::where('faculty_id',null)->distinct()
            ->orderBy('faculty_id')->get();

    

        return view('User.faculty',['name'=>$name,'role'=>$role,'result'=>$multiplied,'res'=>$faculty]);
        

    }

    //添加院系专业，添加老师,添加学生,添加实习地点
    public function add(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $type =  $input_many['type'];
        $user_id = Session::get('id');

        //添加院系专业 type为1，添加院系   type为2，添加专业 type为3，批量添加院系专业
        switch ($type)
        {
            case 1:
                $rules = [
                    'nameFaculty' => 'required|min:4|max:255|unique:faculty,name,' . request('id'),
                ];
                $messages = [
                    'nameFaculty.required' => '请填写院系名称！',
                    'nameFaculty.unique' => '您填写的院系已存在！',
                    'nameFaculty.max' => '用户名长度应小于255个字符！',
                ];
                $this->validate($request, $rules, $messages);
                $date = date('Y-m-d');
                DB::insert('insert into faculty ( name,faculty_id,created_at,create_id) values (?, ?, ?, ?)', [  $input_many['nameFaculty'],null,$date,$user_id]);
                return redirect('/user/fa');
                break;
            case 2:
                $rules = [
                    'names' => 'required|min:4|max:255|unique:faculty,name,' . request('id'),
                    'faculty_id' => 'required',

                ];
                $messages = [
                    'faculty_id.required' => '请选择院系！',
                    'names.required' => '请填写专业名称！',
                    'names.unique' => '您填写的专业已存在！',
                    'names.max' => '用户名长度应小于255个字符！',
                ];
                $this->validate($request, $rules, $messages);
                $date = date('Y-m-d');
                DB::insert('insert into faculty ( name,faculty_id,created_at,create_id) values (?, ?, ?, ?)', [  $input_many['names'], $input_many['faculty_id'],$date,$user_id]);
                return redirect()->back();
                break;
            case 3:
                if ($_FILES["file"]["error"] > 0) {
                    echo "Error: " . $_FILES["file"]["error"] . "<br />";
                }else {
                    $name = $_FILES["file"]["name"];
                    $fileType = pathinfo($name)['extension'];
                    $filePath= $_SERVER['DOCUMENT_ROOT']."/uploads/"."iconv('UTF-8', 'GBK', 'school')"."xls";
                    if($fileType=="xls"||$fileType=="xlsx"){
                        move_uploaded_file($_FILES["file"]["tmp_name"], $filePath);
                        $objPHPExcel = Excel::load($filePath);
                        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
                        foreach($sheetData as $rowkey=>$rowvalue){
                            if($rowkey>1){
                                $faculty_name = trim($rowvalue["A"]);
                                $major_name = trim($rowvalue["B"]);
                                //print_r($faculty_name);
                                if(empty($major_name)){
                                    $rules = [
                                        $faculty_name => 'required|min:4|max:255|unique:faculty,name,' . request('id'),

                                    ];
                                    $messages = [
                                        $faculty_name.'.required' =>'表格中第'. $rowkey.'行的院系数据为空',
                                        $faculty_name.'.unique' =>'表格中第'. $rowkey.'行的院系已经存在',
                                    ];
                                  //  $this->validate($request, $rules, $messages);
                                    $date = date('Y-m-d');
                                    DB::insert('insert into faculty ( name,faculty_id,created_at,create_id) values (?, ?, ?, ?)', [$faculty_name,null,$date,$user_id]);
                                }else{
                                    $faculty = DB::table('faculty')
                                        ->where('name', 'like', '%' . $faculty_name . '%')
                                        ->get()->toArray();
                                    foreach ($faculty as $user){
                                        $faculty_id = $user->id;
                                        $rules = [
                                            $major_name => 'required|min:4|max:255|unique:faculty,name,' . request('id'),

                                        ];
                                        $messages = [
                                            $major_name.'.required' => '表格中第'. $rowkey.'行的专业数据为空',
                                            $major_name.'.unique' => '表格中第'. $rowkey.'行的专业已经存在',
                                        ];
                                        $this->validate($request, $rules, $messages);
                                        $date = date('Y-m-d');
                                        DB::insert('insert into faculty (name,faculty_id,created_at) values (?, ?, ?)', [$major_name,$faculty_id,$date]);
                                    }

                                }

                            }
                        }
                    }else{
                        echo "文件类型不对，返回上一页";
                    }

                }
                return redirect()->back();
                break;
            //添加教师
            case 101:
                $rules = [
                    'te_id' => 'required',
                    'te_name' => 'required|min:2|max:255',
                    'te_tel' => 'required',
                    'te_nation' => 'required',

                ];
                $messages = [
                    'te_name.required' => '请填写老师姓名！',
                    'te_id.required' => '请填写老师工号！',
                    'te_tel.required' => '请填写老师姓名！',
                    'te_nation.required' => '请填写老师民族！',
                    'te_name.min' => '老师姓名至少两个字',
                    'te_name.max' => '老师姓名应小于255个字符！',
                ];
                $this->validate($request, $rules, $messages);
                $date = date('Y-m-d');
                DB::table('user')->insert([
                    ['account' =>  $input_many['te_id'],'role' =>  'teacher','name' =>  $input_many['te_name'],'faculty_id' =>  $input_many['te_faculty_id'],'birth' =>  $input_many['te_birth'],'major_id' =>  $input_many['te_major_id'],'tel' =>  $input_many['te_tel'],'nation' =>  $input_many['te_nation'],'created_at' => $date,'creater_id' => $user_id]
                ]);
                return redirect()->back();
                break;

            //添加学生
            case 102:
                $rules = [
                    'te_id' => 'required',
                    'te_name' => 'required|min:2|max:255',
                    'te_tel' => 'required',
                    'te_nation' => 'required',

                ];
                $messages = [
                    'te_name.required' => '请填写学生姓名！',
                    'te_id.required' => '请填写学生学号！',
                    'te_tel.required' => '请填写学生姓名！',
                    'te_nation.required' => '请填写学生民族！',
                    'te_name.min' => '学生姓名至少两个字',
                    'te_name.max' => '学生姓名应小于255个字符！',
                ];
                $this->validate($request, $rules, $messages);
                $date = date('Y-m-d');
                DB::table('user')->insert([
                    ['account' =>  $input_many['te_id'],'role' =>  'student','name' =>  $input_many['te_name'],'faculty_id' =>  $input_many['te_faculty_id'],'major_id' =>  $input_many['te_major_id'],'birth' =>  $input_many['te_birth'],'tel' =>  $input_many['te_tel'],'nation' =>  $input_many['te_nation'],'created_at' => $date,'creater_id' => $user_id]
                ]);
                return redirect()->back();
                break;
            //添加实习公司
            case 201:
                $rules = [
                    'te_account' => 'required',
                    'te_name' => 'required|min:2|max:255',
                    'te_provice' => 'required',
                    'te_city' => 'required',
                    'te_address' => 'required',
                    'te_tel' => 'required',

                ];
                $messages = [
                    'te_name.required' => '请填写学生姓名！',
                    'te_account.required' => '请填写公司名称！',
                    'te_tel.required' => '请填写公司电话！',
                    'te_provice.required' => '请填写公司所在省份！',
                    'te_city.required' => '请填写公司所在省份！',
                    'te_address.required' => '请填写公司所在地址！',
                    'te_name.min' => '公司名称至少两个字',
                    'te_name.max' => '公司名称应小于255个字符！',
                ];
                $this->validate($request, $rules, $messages);

                $date = date('Y-m-d'); 
                DB::insert('insert into address (name,account,provice,city,tel,address,created_at,creater_id) values (?, ?, ?, ?, ?, ?, ?, ?)', [$input_many['te_name'], $input_many['te_account'],$input_many['te_provice'], $input_many['te_city'], $input_many['te_tel'],  $input_many['te_address'],$date,$user_id]);

                DB::insert('insert into user (name,account,creater_id,role,tel) values (?, ?, ?, ?, ?)', [$input_many['te_name'], $input_many['te_account'], $user_id,'address',$input_many['te_tel']]);
                //                DB::table('address')->insert([
//                    ['account' =>  $input_many['te_account'],'name' =>  $input_many['te_name'],'provice' =>  $input_many['te_provice'],'city' =>  $input_many['te_city'],'tel' =>  $input_many['te_tel'],'address' =>  $input_many['te_address']]
//                ]);
                return redirect()->back();
                break;

            default:
                echo "出错了，返回上一页";
                return redirect()->back();
        }

    }
    public function addAddress(Request $request){

        $input_many=$request->except(['_token','create_time']);
        $user_id = Session::get('id');
        $rules = [
            'account' => 'required',
            'name' => 'required|min:2|max:255',
            'provice' => 'required',
            'city' => 'required',
            'address' => 'required',
            'tel' => 'required',

        ];
        $messages = [
            'name.required' => '请填写公司名称！',
            'account.required' => '请填写公司编号！',
            'tel.required' => '请填写公司电话！',
            'provice.required' => '请填写公司所在省份！',
            'city.required' => '请填写公司所在省份！',
            'address.required' => '请填写公司所在地址！',
            'name.min' => '公司名称至少两个字',
            'name.max' => '公司名称应小于255个字符！',
        ];
        $this->validate($request, $rules, $messages);
        $date = date('Y-m-d');
        DB::insert('insert into address (name,account,provice,city,tel,contacts,address,created_at,creater_id,jy) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$input_many['name'], $input_many['account'],$input_many['provice'], $input_many['city'], $input_many['tel'] , $input_many['contacts'],  $input_many['address'],$date,$user_id,$user_id]);
        DB::insert('insert into user (name,account,creater_id,role,tel) values (?, ?, ?, ?, ?)', [$input_many['name'], $input_many['account'], $user_id,'address',$input_many['tel']]);
        return redirect()->back();
    }

    //修改院系专业
    public function updateFaculty(Request $request){

        $input_many=$request->except(['_token','create_time']);
        $this->validate($request, [
            'faculty' => 'required',
        ]);
        $re=str_replace("-",'',$input_many['major']);
        $faculty = $input_many['faculty'];
        $id =$input_many['id'];
        if($re==''){
            $num = DB::update('update faculty set name = ? where id = ?',[$faculty,$id]);
        }else{

            $num = DB::update('update faculty set name = ? where id = ?',[$re,$id]);
        }
        if($num){
            return redirect('/user/fa');
        }else{
            var_dump("修改失败，正在返回上一页······");
            return false;
        }


}

    //删除院系
    public function delFaculty($id){
        $id= explode(",",$id);
        $users = DB::table('faculty')->whereIn('id',$id)->get();
        $num = 0 ;
        foreach ($users as $userss) {
            $faculty_id = $userss->faculty_id;
            $idd = $userss->id;
            if ($faculty_id==null){
                DB::delete("delete from faculty where id = '".$idd."'");
                DB::delete("delete from faculty where faculty_id = '".$idd."'");
                $num++;

            }else{
                DB::delete("delete from faculty where id = '".$idd."'");
                $num++;

            }
        }
        if($num){
            return redirect('/user/fa');
        }else{
            return "删除失败";
        }

    }

    //删除实习地点
    public function delAddress($id){
        $id = trim($id,",");
        $num =  DB::delete("delete from address where id in "."(".$id.")");
        if($num){
            return redirect()->back();
        }else{
            return "删除失败";
        }

    }

    //查询院系
    public function searchFaculty(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $faculty_id =  $input_many['faculty_id'];
        $sMajor = $input_many['ss'];
        if ($faculty_id==0&&$sMajor==""){
            $faculty =  DB::table('faculty')->get();
        }else {
            if ($faculty_id == 0) {
                $faculty = DB::table('faculty')
                    ->where('name', 'like', '%' . $sMajor . '%')->get();
            }elseif($sMajor==""){
                $faculty = DB::table('faculty')
                    ->where('id', '=', $faculty_id)
                    ->orWhere('faculty_id', '=', $faculty_id)
                    ->get();
            }else{
                $faculty = DB::table('faculty')
                    ->where([['name', 'like', '%' . $sMajor . '%'],['faculty_id', '=', $faculty_id]])
                    ->get();

            }
        }
    }
    
    //教师管理首页
    public function teacher(){

        $result = User::where('role', "teacher")->distinct()->get();
        //        从院系专业表中晒选出院校专业
        $multiplied = $result->transform(function ($item, $key) {
            $item->faculty_name = $key;
            $item->major_name = $key;
            $item->creater_name = $key;
            return $item;
        });

        foreach ($result as $user) {
            $creater_id =  $user->creater_id;
            $faculty_id =  $user->faculty_id;
            $major_id =  $user->major_id;
            $faculty= DB::table('faculty')->distinct()->where('id', $faculty_id)->get();
            foreach ($faculty as $userss) {
                $user->faculty_name = $userss->name;
            }
            $major = DB::table('faculty')->distinct()->where('id', $major_id)->get();
            foreach ($major as $userss) {
                $user->major_name = $userss->name;
            }
            $creater = DB::table('user')->distinct()->where('id', $creater_id)->get();
            foreach ($creater as $userss) {
                $user->creater_name = $userss->name;
            }
        }
        $faculty=  Faculty::distinct()->get();
        $name = Session::get('name');
        $role = Session::get('role');
        return view('User.teacher',['name'=>$name,'role'=>$role,'result'=>$result,'res'=>$faculty]);
    }

    //删除用户
    public function delUser($id){
       $id = trim($id,",");
       $num =  DB::delete("delete from user where id in "."(".$id.")");
        if($num){
            return redirect()->back();
        }else{
            return "删除失败";
        }
    }

    //修改用户
    public function updateUser(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $this->validate($request, [
        ]);
        $id =$input_many['u_id'];
        $name=$input_many['ute_name'];
        $account=$input_many['uaccount'];
        $te_faculty_id=$input_many['ute_faculty_id'];
        $te_major_id=$input_many['ute_major_id'];
        $tel=$input_many['ute_tel'];
        $nation=$input_many['ute_nation'];
        $birth=$input_many['ute_birth'];
        DB::update('update user set name = ? , account = ? , faculty_id = ? , major_id = ? , tel = ? , nation = ? , birth = ? where id = ?',[$name,$account,$te_faculty_id,$te_major_id,$tel,$nation,$birth,$id]);
        return redirect()->back();
    }

    //搜索用户
    public function selUser(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $faculty_id =  $input_many['faculty_id'];
        $major_id =  $input_many['se_major_id'];
        $sMajor = $input_many['sMajor'];
        $input_role = $input_many['role'];
        if($input_role=='teacher'){
            if ($faculty_id==0&&$major_id==0){
                if($sMajor==""){
                    $result = DB::table('user')
                        ->where([['role','=','teacher']])->get();
                }else{
                    $result = DB::table('user')
                        ->where([['name', 'like', '%' . $sMajor . '%' ],['role','=','teacher']])->get();
                }
            }else {
                if($sMajor==""){
                    if ($major_id == 0) {
                        $result = DB::table('user')
                            ->where([['faculty_id', '=', $faculty_id ],['role','=','teacher']])->get();
                    }else{
                        $result = DB::table('user')
                            ->where([['faculty_id', '=', $faculty_id ],['major_id','=',$major_id ],['role','=','teacher']])->get();

                    }
                }else{
                    if ($major_id == 0) {
                        $result = DB::table('user')
                            ->where([['faculty_id', '=', $faculty_id ],['name', 'like', '%' . $sMajor . '%' ],['role','=','teacher']])->get();
                    }else{
                        $result = DB::table('user')
                            ->where([['faculty_id', '=', $faculty_id ],['name', 'like', '%' . $sMajor . '%' ],['major_id','=',$major_id ],['role','=','teacher']])->get();

                    }

                }

            }
        }elseif($input_role=="student"){
            if ($faculty_id==0&&$major_id==0){
                if($sMajor==""){
                    $result = DB::table('user')
                        ->where([['role','=','student']])->get();
                }else{
                    $result = DB::table('user')
                        ->where([['name', 'like', '%' . $sMajor . '%' ],['role','=','student']])->get();
                }
            }else {
                if($sMajor==""){
                    if ($major_id == 0) {
                        $result = DB::table('user')
                            ->where([['faculty_id', '=', $faculty_id ],['role','=','student']])->get();
                    }else{
                        $result = DB::table('user')
                            ->where([['faculty_id', '=', $faculty_id ],['major_id','=',$major_id ],['role','=','student']])->get();

                    }
                }else{
                    if ($major_id == 0) {
                        $result = DB::table('user')
                            ->where([['faculty_id', '=', $faculty_id ],['name', 'like', '%' . $sMajor . '%' ],['role','=','student']])->get();
                    }else{
                        $result = DB::table('user')
                            ->where([['faculty_id', '=', $faculty_id ],['name', 'like', '%' . $sMajor . '%' ],['major_id','=',$major_id ],['role','=','student']])->get();

                    }

                }

            }
        }

        foreach ($result as $user) {
            $creater_id =  $user->creater_id;
            $faculty_id =  $user->faculty_id;
            $major_id =  $user->major_id;
            $faculty= DB::table('faculty')->distinct()->where('id', $faculty_id)->get();
            foreach ($faculty as $userss) {
                $user->faculty_name = $userss->name;
            }
            $major = DB::table('faculty')->distinct()->where('id', $major_id)->get();
            foreach ($major as $userss) {
                $user->major_name = $userss->name;
            }
            $creater = DB::table('user')->distinct()->where('id', $creater_id)->get();
            foreach ($creater as $userss) {
                $user->creater_name = $userss->name;
            }
        }
        $faculty=  Faculty::distinct()->get();
        $name = Session::get('name');
        $role = Session::get('role');

        if($input_role=='teacher'){
            return view('User.teacher',['name'=>$name,'role'=>$role,'result'=>$result,'res'=>$faculty]);
        }elseif ($input_role == 'student'){
            return view('User.student',['name'=>$name,'role'=>$role,'result'=>$result,'res'=>$faculty]);
        }
    }
    
    //修改实习公司
    public function updateAddress(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $this->validate($request, [
        ]);
        $id =$input_many['uid'];
        $name=$input_many['uname'];
        $account=$input_many['uaccount'];
        $provice=$input_many['uprovice'];
        $city=$input_many['ucity'];
        $tel=$input_many['utel'];
        $address=$input_many['uaddress'];
        DB::update('update address set account = ?, name = ? , provice = ? , city = ? , address = ? , tel = ?  where id = ?',[$account,$name,$provice,$city,$address,$tel,$id]);
        return redirect()->back();
    }
    
    //学生管理首页
    public function student(){

        $result = User::where('role', "student")->distinct()->get();
        $multiplied = $result->transform(function ($item, $key) {
            $item->faculty_name = $key;
            $item->major_name = $key;
            $item->creater_name = $key;
            return $item;
        });

        foreach ($result as $user) {
            $faculty_id =  $user->faculty_id;
            $major_id =  $user->major_id;
            $creater_id =  $user->creater_id;
            $faculty= DB::table('faculty')->distinct()->where('id', $faculty_id)->get();
            foreach ($faculty as $userss) {
                $user->faculty_name = $userss->name;
            }
            $major = DB::table('faculty')->distinct()->where('id', $major_id)->get();
            foreach ($major as $userss) {
                $user->major_name = $userss->name;
            }
            $creater = DB::table('user')->distinct()->where('id', $creater_id)->get();
            foreach ($creater as $userss) {
                $user->creater_name = $userss->name;
            }
        }
        //        从院系专业表中晒选出院校专业
        $faculty=  Faculty::distinct()->get();
        $name = Session::get('name');
        $role = Session::get('role');
         return view('User.student',['name'=>$name,'role'=>$role,'result'=>$result,'res'=>$faculty]);
    }

    //实习公司管理首页
    public function address(){

        $result = Address::distinct()->get();
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
        $name = Session::get('name');
        $role = Session::get('role');
        return view('User.address',['name'=>$name,'role'=>$role,'result'=>$result]);
    }
    //实习公司给学生评分
    public function addressPfStu(){

        $user_id = Session::get('id');

        $address =  DB::table('user')->where('id',$user_id)->get();
        foreach ($address as $vv){
            $address_account = $vv->account;
        }
        $address_dd =  DB::table('address')->where('account',$address_account)->get();
        foreach ($address_dd as $v1v){
            $address_id = $v1v->id;
        }
        $group =  DB::table('group')->where('address_id',$address_id)->get();
        $stu_ids = "";
        foreach($group as $value){

            $stu_ids .= $value->stu_id;
            $stu_ids .= ",";
        }
        $stu_ids = trim($stu_ids,',');
        $stu_ids = explode(',',$stu_ids);
        $result =  DB::table('user')->whereIn('id',$stu_ids)->get();
        $result->transform(function ($item, $key) {
            $item->faculty_name = " ";
            $item->major_name = " ";
            $item->fenshu = " ";
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
            $mission_detail = DB::table('mission_detail')->where([['mission_id', '999999'],['stu_id',$stu_id]])->get();
            foreach ($mission_detail as $userss22) {
                $user->fenshu = $userss22->fenshu;
            }

        }
        $name = Session::get('name');
        $role = Session::get('role');
        return view('Mission.address',['name'=>$name,'role'=>$role,'result'=>$result]);
    }

}