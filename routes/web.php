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

Route::get('/', function () {
    return redirect('/mainpage2');
    
    //return view('welcome');
});
Route::get('/mainpage',function(){
    return View::make("mainpage")->with("imgpath","images/mainpage");
});
Route::get('/mainpage2',function(){
    $navitem = array(array("title"=>"html","link"=>"#"),array("title"=>"css","link"=>"#"),array("title"=>"js","link"=>"#"),array("title"=>"내정보","link"=>"#"),array("title"=>"live 코딩","link"=>"#"));
    return View::make("mainpage2")->with("imgpath","images/mainpage")->with("navitems",$navitem);
});
Route::get("/login/github",function(){
    return Socialite::driver('github')->redirect();
});
Route::get("/login/github/callback",function(){
    $user = Socialite::driver('github')->stateless()->user();
    $li = array();
    $li["loginsession"] = $user->token;
    $li["name"] = $user->getNickname();
    $li["numid"] = $user->getId();
    $li["loginprovider"] = "github";
    $li["test"] = "ls";
    try{
    DB::insert("insert into userlist(loginprovider,id,storage_session_id) values(?,?,concat(sha2(?,512),md5(now())));",array("github",$li["name"],"github".$li["name"]));
    }catch(Exception $e){

    }
    DB::update("update userlist set lastest_logined_date=now() where loginprovider='github' and id=?",array($li["name"]));
    Session::put("logininfo",$li);
    return redirect('/mainpage2');
    //dd($user);
});
Route::get("/logout",function(){
    Session::flush();
    return redirect('/mainpage2');
    
});
Route::get('/studypage',function(){
    return View::make("studypage")->with("imgpath","images/studypage");
});
Route::get('/test', function () {
    return View::make("test")->with("msg","Hi!, Admin3.");
});