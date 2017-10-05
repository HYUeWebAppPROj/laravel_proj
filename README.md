# laravel_proj
백엔드 환경
--------------
하위는 이 레포 폴터로 부터 상대적경로  
css 는  public/css에 저장및 불러오기, 불러올떄는 href="css/file name"  
javascript는 public/js에 저장및 불러오기  
image는 public/images에 저장및 불러오기  
작업 php파일은 resources/views폴터에 뷰클래스명.blade.php 같은 파일명으로 저장  
restful API 같은 라우트처리는 routes/web.php에서 관리  
등으로 처리  
기타 폴터별 기능을 알고 싶으면 https://www.lesstif.com/pages/viewpage.action?pageId=24445288 으로 접속  
  
* 실행
apache와 같이 쓰고 싶으면 apache설정에서 public 폴터를 가상폴터로 등록 후 가상 폴터의 path로 접속
단독적으로 쓰고 싶으면 커맨드창에서 이 레포 폴더로 이동후 'php artisan serve' 따옴표안에 있는 명령입력(서버종료할때는 컨트롤버튼+c 누르면됨-맥기준, php는 아마 환경변수에서 경로추가해줘야 동작할듯)
