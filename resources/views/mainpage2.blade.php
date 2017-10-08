<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
@include("mobileview.init")
{{HTML::style('css/mainpage2.css')}}

</head>
<body>
<p id="bl" class="btns_layout">
@if(Session::get("logininfo"))
<a href="./logout"><button>Log out</button></a>
@else
<a href="./login/github"><button>Log in</button></a>
@endif
</p>
<header>
<img src="https://images.google.com/images/branding/googleg/1x/googleg_standard_color_128dp.png" alt="logo image"/>

<h1>코딩교육사이트</h1>
</header>
@include("mpgnav")
<section>
    <div id="slides">
        <img class="imgad" src="{{asset($imgpath.'/html.jpg')}}"/>
	    <img class="imgad" src="{{asset($imgpath.'/css.jpg')}}"/>
	    <img class="imgad" src="{{asset($imgpath.'/js.png')}}"/>
	    <img class="imgad" src="{{asset($imgpath.'/php.jpg')}}"/>
	 <a href="#" class="slidesjs-previous slidesjs-navigation">이전</a><!--이전버튼-->
     <a href="#" class="slidesjs-next slidesjs-navigation">다음</a><!--다음버튼-->
    </div>
    <div class="flex-layout flex-layout-horizontal">
        <div class="flex-item-lv1">
            <?php if( Session::has("logininfo") ){ ?>
            <h2>환영합니다 {{Session::get("logininfo")["name"]}}</h2>
            
            <?php var_dump(Session::get("logininfo"));  ?>
            <?php } else { ?>
            <form>
                <input  type="text"></input><br/>
                <input type="password"></input><br/>
                <input type="button" value="로그인" />
            </form>
                <a class="btn-oauth-github" href="./login/github">Login with Github</a>
            <?php } ?>
        </div>
        <div class="flex-item-lv1">
        공지사항 부분
        </div>
    </div>
</section>
<footer>
</footer>
{{HTML::script('http://code.jquery.com/jquery-latest.min.js')}}
{{HTML::script('https://cdnjs.cloudflare.com/ajax/libs/slidesjs/3.0/jquery.slides.min.js')}}
<script>
 $(function(){
      $("#slides").slidesjs({
        width: 1000,
        height: 528,
         navigation: {
      active: true,
      effect: "slide"
    },
    play: {
				active: true, //플레이 스탑버튼 사용유무(버튼변경불가)
				effect: "slide",//효과 slide, fade
				interval: 3000,//밀리세컨드 단위 5000 이면 5초
				auto: true, //시작시 자동 재생 사용유무
				swap: true, //플레이스 스탑버튼 둘다보임 false, 하나로 보임 true
				pauseOnHover: false,//마우스 올렸을때 슬라이드 멈춤할껀지 말껀지
				restartDelay: 2500//마우스 올렸다가 벗어 났을때 재 작동 시간 밀리세컨드 단위
				//css slidesjs-play, slidesjs-stop 이부분을 이용해서 커스터마이징 가능함
			},
    effect: {
				slide: {
				// 슬라이드 효과
					speed: 700
					// 0.2초만에 바뀜
				},
				fade: {
				// 페이드 효과
					speed: 500,
					// 0.3초만에 바뀜
					crossfade: true
					// 다음이미지와 겹쳐서 나타남 유무
				}
			},

      });
    });
</script>
</body>
</html>