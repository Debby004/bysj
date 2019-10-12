<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/22
 * Time: 10:00
 */
if(!function_exists('fun1')){
     function fun1(){
         echo 123;
    }

};
if(!function_exists('setCookie')){
    function setCookie($id){
        setcookie("id", $id, time()+3600);
        echo $id;
    }

};
if(!function_exists('getCookie')){
    function getCookie($cookieName){

        $data = isset($_COOKIE[$cookieName]) ? $_COOKIE[$cookieName] : '';
        return $data;
    }

}


