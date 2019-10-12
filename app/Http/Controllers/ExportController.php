<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/3
 * Time: 14:57
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

use Excel;
class ExportController extends Controller
{
    //Excel文件导出功能

   public function index(){


       $cellData = DB::table('faculty')->get()->toArray();
       $info[count($cellData)] = array('编号','院系','专业');
       for($i=0;$i<count($cellData);$i++){
           $faculty_id =  $cellData[$i]->faculty_id;
           if($faculty_id==''){
               $cellData[$i]->faculty_name =  $cellData[$i]->name;
               $cellData[$i]->name ="";
           }else{
               $users = DB::table('faculty')->distinct()->where('id', $faculty_id)->get();
               foreach ($users as $userss) {
                   $cellData[$i]->faculty_name = $userss->name;
               }
           }
           $info[$i][] = $cellData[$i]->id;
           $info[$i][] = $cellData[$i]->faculty_name;
           $info[$i][] = $cellData[$i]->name;
       }

       Excel::create(iconv('UTF-8', 'GBK', 'school'),function($excel) use ($info){
           $excel->sheet('score', function($sheet) use ($info){
               $sheet->rows($info);
           });
       })->export('xls');

    }

    }