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

/* 현재 모든 로직이 web.php, 즉 view에서 처리되고 있는데, 나중에 컨트롤러에 로직을 위임하게끔 리팩
   토링 할것임. */


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PHPHtmlParser\Dom;
$navitem = array(array("title"=>"html","link"=>"#"),array("title"=>"css","link"=>"#"),array("title"=>"js","link"=>"#"),array("title"=>"내정보","link"=>"./studypage"),array("title"=>"live 코딩","link"=>"#"));
$_ENV['navitem']=$navitem;
Route::get('/', function () {
    return redirect('/mainpage2');

    //return view('welcome');
});
Route::get('/mainpage',function(){
    return View::make("mainpage")->with("imgpath","images/mainpage");
});
Route::get('/mainpage2',function(){
    #$navitem = array(array("title"=>"html","link"=>"#"),array("title"=>"css","link"=>"#"),array("title"=>"js","link"=>"#"),array("title"=>"내정보","link"=>"#"),array("title"=>"live 코딩","link"=>"#"));
    return View::make("mainpage2")->with("imgpath","images/mainpage")->with("navitems",$_ENV['navitem']);
});
Route::post('/login/normal',function(){
    $id = Input::get('loginid', null);
    $pw = Input::get('loginpw', null);
    if($id!=null && $pw !=null && $id==="adminHYU123" && $pw ==="@HYUeWebAppPROj"){
        $li = array();
        $li["loginsession"] = Session::getId();
        $li["name"] = $id;
        $li["realname"] = "admin";
        $li["numid"] = 123456789;
        $li["email"] = "unknown";
        $li["avatar"] = "https://upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Microsoft_Account.svg/768px-Microsoft_Account.svg.png";
        $li["loginprovider"] = "normal";
        Session::put("logininfo",$li);
    }
    //return "data:{$id}\n<br>{$pw}";
    return redirect('/mainpage2');
});
Route::get("/login/github",function(){
    return Socialite::with('github')->redirect();
});
Route::get("/login/github/callback",function(){
    $user = Socialite::with('github')->stateless()->user();
    $li = array();
    $li["loginsession"] = $user->token;
    $li["name"] = $user->getNickname();
    $li["realname"] = $user->getName();
    $li["numid"] = $user->getId();
    $li["email"] = $user->getEmail();
    $li["avatar"] = $user->getAvatar();
    $li["loginprovider"] = "github";
   try{
        DB::table("userlist")->insert(["loginprovider"=>"github","id"=>$li["name"],"storage_session_id"=>DB::raw("concat(sha2('github".$li["name"]."',512),md5(now()))")]);
    //DB::insert("insert into userlist(loginprovider,id,storage_session_id) values(?,?,concat(sha2(?,512),md5(now())));",array("github",$li["name"],"github".$li["name"]));
    }catch(Exception $e){ }
    DB::table("userlist")->where([["loginprovider",'=',"github"],["id",'=',$li["name"]]])->update(["lastest_logined_date"=>DB::raw("now()")]);
    //DB::update("update userlist set lastest_logined_date=now() where loginprovider='github' and id=?",array($li["name"]));
    Session::put("logininfo",$li);
    return redirect('/mainpage2');
    //dd($user);
});
Route::get("/logout",function(){
    Session::flush();
    return redirect('/mainpage2');

});
Route::get('/studypage',function(){
    $ver = (int)Input::input('ver', 1);
    return $ver===1?View::make("studypage")->with("imgpath","images/studypage"):View::make("studypage2")->with("navitems",$_ENV['navitem']);
});
Route::any('/marketpage', function () {

    return View::make("marketpage")->with("navitems",$_ENV['navitem']);
    //return View::make("test")->with("msg","Hi!, Admin3.");
});

Route::post('/marketpage/purchased', function () {
    $checked_purchase = Input::get('recheck');
    $li = Session::get("logininfo");
    $id_prob = $li["loginprovider"];
    $id_name = $li['name'];
    // foreach($checked_purchase as $val){

    // DB::table('')
    // DB::insert("insert into user_registered_courses values('?','?',?,0,now());",array($id_prob,$id_name,1,10));
// }
//     return $checked_purchase;
     return redirect('/marketpage');

});

Route::post('/marketpage/purchasepage', function () {

    return View::make("purchasepage")->with("navitems",$_ENV['navitem']);
    //return View::make("test")->with("msg","Hi!, Admin3.");
});
Route::get('/test', function () {

    //return View::make("sampleresponsive")->with("navitems",$_ENV['navitem']);

    return View::make("test")->with("msg","Hi!, Admin3.");
});
Route::get('/codepage', function () {
    return View::make("codepage")->with("navitems",$_ENV['navitem']);
    //return View::make("test")->with("msg","Hi!, Admin3.");
});
Route::post('/codepage/api/{api_mode}',function(Request $req,$api_mode){
    $ipt = $req->json()->all();
    $rst = array();
    if(isset($ipt['id_provider'])&&isset($ipt['id'])&&isset($ipt['data'])){
        $id = $ipt['id'];
        $data = $ipt['data'];
        $id_provider = $ipt['id_provider'];
        $qry = DB::table('loginserviceprovider')->select('provider')->get();
        $providers = array();
        foreach($qry as $key => $value){
            array_push($providers,$value->provider);
        }
        if(preg_match("/^(".implode("|",$providers).")$/",$qry[0]->provider)){
            $dom = new Dom;
            $dom->load($data);
            //$rst["success_msg"]=  print_r($dom->find('h1')[0]->text,TRUE);
            //$rst["success"] = true;
            $rst["result_data"] = $dom->outerHtml;
            $rst["course_success"]=false;
            $rst["code_success"]=true;
            $user_status = array();
            $user_status["success"] = false;
            $user_status["point"] = 1;
            $rst["user"]=$user_status;
        }

    }

    return Response::json($rst);
})->where(['api_mode' => '^(html|js|php|css)$']);
