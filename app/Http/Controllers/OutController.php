<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/11
 * Time: 14:13
 */
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
class OutController extends Controller{
    public function index(){
        $name = Session::get('name');
        $role = Session::get('role');
        return redirect('/');
    }
}