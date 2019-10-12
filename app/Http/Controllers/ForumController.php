<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/11
 * Time: 13:54
 */
 
namespace  App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Forum;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
class ForumController extends Controller
{
    public $timestamps = true;
    public function index(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $forum_name = isset($input_many['name'])?$input_many['name']:null;
        if($forum_name == null){
            $forum=  Forum::distinct()->get();
        }else{
            $forum = DB::table('forum')
                ->where([['name', 'like', '%' . $forum_name . '%']])
                ->get();
        }
        $name = Session::get('name');
        $role = Session::get('role');
        return view('Forum/index',['name'=>$name,'role'=>$role,'forum'=>$forum]);
    }

    //添加院系专业，添加老师,添加学生,添加实习地点
    public function add(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $rules = [
            'name' => 'required|unique:forum,name,' . request('id'),
            'descript' => 'required',

        ];
        $messages = [
            'name.required'=>"请输入论坛栏目",
            'name.unique'=>"论坛栏目已经存在，请重新设置论坛栏目",
            'descript.required'=>"请输入论坛描述",
        ];
        $this->validate($request, $rules, $messages);
        DB::insert('insert into `forum` ( name,descript) values (?,?)', [$input_many['name'],$input_many['descript']]);
        return redirect()->back();

    }
    public function del($id){
        $id = trim($id,",");
        $num =  DB::delete("delete from `forum` where id in "."(".$id.")");
        if($num){
            return redirect()->back();
        }else{
            return "删除失败";
        }
    }
    //修改论坛栏目
    public function update(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $this->validate($request, [
        ]);
        $id =$input_many['up_id'];
        $name=$input_many['up_name'];
        $descript=$input_many['up_descript'];
        DB::update('update `forum` set name = ? , descript = ?  where id = ?',[$name,$descript,$id]);
        return redirect()->back();
    }

    //查询论坛栏目
    public function sel(Request $request){
        $input_many=$request->except(['_token','create_time']);
        $name =  $input_many['name'];
        $forum = DB::table('forum')
            ->where([['name', 'like', '%' . $name . '%']])
            ->get();

    }

}