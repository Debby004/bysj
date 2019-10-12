<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::any('/','LoginController@info');


Route::any('/check','LoginController@check');
Route::any('/reg','LoginController@reg');
Route::any('/user','UserController@index');

//用户管理
Route::any('/user/del/{id}' , 'UserController@delFaculty'); 
Route::any('/user/update','UserController@updateFaculty');
Route::any('/user/fa','UserController@faculty');
Route::any('/user/seaFa','UserController@searchFaculty');
Route::any('/user/add','UserController@add');
Route::any('/user/addAddress','UserController@addAddress');
Route::any('/user/te','UserController@teacher');
Route::any('/user/stu','UserController@student');
Route::any('/user/address','UserController@address');
Route::any('/user/selUser','UserController@selUser');
Route::any('/user/updateUser','UserController@updateUser');
Route::any('/user/updateAddress','UserController@updateAddress');
Route::any('/user/delUser/{id}','UserController@delUser');
Route::any('/user/delAddress/{id}','UserController@delAddress');
Route::any('/export/index','ExportController@index');



Route::any('/common', 'CommonController@index');
Route::any('/setting', 'SettingController@index');
Route::any('/setting/add', 'SettingController@add');

//实习组
Route::any('/group', 'GroupController@index');
Route::any('/groupTea', 'GroupController@groupTea');
Route::any('/group/update_t_s/{id}', 'GroupController@updateTeaStu');
Route::any('/group/addTea/{id}/{groupId}', 'GroupController@addTea');
Route::any('/group/addStu/{id}/{groupId}', 'GroupController@addStu');
Route::any('/group/addAddress/{id}/{groupId}', 'GroupController@addAddress');
Route::any('/group/delGroupUser/{id}/{groupId}', 'GroupController@delGroupUser');
Route::any('/group/addGroup', 'GroupController@addGroup');
Route::any('/group/delGroup/{id}', 'GroupController@delGroup');
Route::any('group/update', 'GroupController@update');
Route::any('/group/stu', 'GroupController@stu');
//评分

Route::any('/mission/fenshu', 'MissionController@fenshu');
Route::any('/mission/pingfen', 'MissionController@pingfen');
Route::any('/user/addressPfStu', 'UserController@addressPfStu');

//实习任务
Route::any('/mission', 'MissionController@index');
Route::any('/mission/addMission', 'MissionController@addMission');
Route::any('/mission/delMission/{id}', 'MissionController@delMission');
Route::any('/mission/update', 'MissionController@update');
Route::any('/mission/devMission/{id}/{gid}', 'MissionController@devMission');

Route::any('/missions', 'MissionController@stu');
Route::any('/missions/det/{id}', 'MissionController@misDet');
Route::any('/mission/stuadd', 'MissionController@stuadd');
Route::any('/mission/addressPingfen', 'MissionController@addressPingfen');
Route::any('/zhaopin', 'ForumdetController@zhaopin');
Route::any('/fbzhaopin', 'ForumdetController@fbzhaopin');


//论坛管理
Route::any('/forum', 'ForumController@index');
Route::any('/forum/add', 'ForumController@add');
Route::any('/forum/del/{id}', 'ForumController@del');
Route::any('/forum/update', 'ForumController@update');
Route::any('/forum/sel', 'ForumController@sel');


//论坛
Route::any('/forumdet/index', 'ForumdetController@index');
Route::any('/forumdet/det/{id}', 'ForumdetController@det');
Route::any('/forumdet/reply/{id}', 'ForumdetController@reply');
Route::any('/forumdet/addForum', 'ForumdetController@addForum');
Route::any('/forumdet/replyForum', 'ForumdetController@replyForum');
//就业信息填写
Route::any('/jiuye', 'JiuyeController@index');

//新闻管理
Route::any('/news', 'NewsController@index');
Route::any('/news/addNews', 'NewsController@addNews');
Route::any('/news/delNews/{id}', 'NewsController@delNews');


Route::any('/count', 'CountController@index');
//短消息管理
Route::any('/message', 'MessageController@index');
Route::any('/message/addMessage', 'MessageController@addMessage');
Route::any('/message/delMessage/{id}', 'MessageController@delMessage');


Route::any('/personal', 'PersonalController@index');
Route::get('excel/export','ExcelController@export');
Route::get('excel/import','ExcelController@import');
Route::get('/download/{path}','DownloadController@down');
Route::get('/download/{path}','DownloadController@down');
//退出系统


Route::get('/out','OutController@index');
 
