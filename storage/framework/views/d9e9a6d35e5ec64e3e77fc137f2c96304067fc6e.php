<!DOCTYPE <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlightjs-line-numbers.js/2.1.0/highlightjs-line-numbers.min.js"></script>
    <?php echo e(HTML::style('css/codepage.css')); ?>

    <?php echo e(HTML::style('css/show_hidden.css')); ?>

    <?php echo e(HTML::style('css/flex_layout.css')); ?>

<?php echo e(HTML::style('css/fluid_layout.css')); ?>


</head>
<body ng-app="codingApp" ng-controller="MainCtrl">
    <input type="checkbox" id="dialogshow" hidden></input>
    <div class="dialogwindow" >
        <section >
            <header class="flex-layout">
                <div class="flex-item-lv1 dialog-title-bar" ><p>제출결과</p></div>
                <p class="dialog-button-close">
                <label for="dialogshow">X</label>
                </p>
            </header>
            <article class="dialog-content-area y-scrollable flex-item-lv2 flex-layout-md flex-layout-md-horizontal flex-layout-lg flex-layout-lg-horizontal flex-layout-xlg flex-layout-xlg-horizontal">
                
                 <div class="demo flex-item-md-lv1 flex-item-lg-lv1  flex-item-xlg-lv1 " >
                <pre><code class="html" ng-bind="submitResult"></code></pre>
                 
                 </div>
                <div class="demo flex-item-md-lv1 flex-item-lg-lv1 flex-item-xlg-lv1 flex-layout-md flex-layout-md-vertical flex-layout-lg flex-layout-lg-vertical flex-layout-xlg flex-layout-xlg-vertical">
                <iframe class="flex-item-lv1" style="width:100%" ng-src="<%% makeIframeData(submitResult) %%>"></iframe>
                <div class="flex-item-lv1" style="background-color:red;">demo:
                <%% demo.result_user %%>
                </div>
                </div>
                
                
            </article>
            <footer>
            <button class="demo2">다음</button>
            </footer>
        </section>
    </div>
    <nav>
        <input type="checkbox" id="mbtn" hidden></input>
        <div class="hidden-md hidden-lg hidden-xlg ">
        <div class="flex-layout flex-layout-horizontal ">
            <p class="flex-item-lv1 mobile-menu-btn" ><label for="mbtn">≡</label></p>
            <div class="flex-item-lv12 nav-logo ">
                <img src="https://images.google.com/images/branding/googleg/1x/googleg_standard_color_128dp.png" alt="logo image"/>
                <div class="inlineblk" id="mobilecs"></div>
                <!--<h1>Jr. CHAP</h1> -->
                <p class="inlineblk">Title-<%% navdata.courseSelect %%> Introduction and Basic Grammar</p>
            </div>
        </div>
        </div>
<?php 
$examlist = array("HTML","JavaScript","CSS","PHP");
?>

        <ul class="menu">
            <li class="hoverable hidden-xsm hidden-sm">
            <p><span>←</span> 되돌아가기   </p>
            </li>
            <li><div><p id="csloc"><select id="courseselector" ng-init="navdata.courseSelect = '<?=$examlist[0]?>'" ng-model="navdata.courseSelect" ng-change="modeChanged()">
            <?php 
            foreach($examlist as $item){?>
            <option value="<?=$item?>"><?=$item?></option>
            <?php } ?>
            </select></p></div></li>
            <li class="forceflex1 maintitle hidden-xsm hidden-sm"><p>Title-<%% navdata.courseSelect %%> Introduction and Basic Grammar</p></li>
            <li><div><p>usr ico</p></div></li>
        </ul>
    </nav>
    <section class="contentarea flex-layout-md flex-layout-md-horizontal flex-layout-lg flex-layout-lg-horizontal flex-layout-xlg flex-layout-xlg-horizontal">
     
     <!--
     <div style="position:absolute;left:10%;z-index:50;"> <%% makeIframeData(editor.demodata) %%>
     </div>
     -->
     <div class="demo flex-item-md-lv3 flex-item-lg-lv3  flex-item-xlg-lv3 ">
     <div class="coding-toolbar">
     </div>
     <div class="coding-block">
     demo</div>
     </div>
     <div class="demo flex-item-md-lv9 flex-item-lg-lv9 flex-item-xlg-lv9" >
     <div class="coding-toolbar">
     <ul>
        <li><div><p>저장</p></div></li>
        <li><div><p>되돌리기</p></div></li>
        <li><div><p>코드 초기화</p></div></li>
     </ul>
     </div>
     <div class="coding-block" ui-ace="{mode:'<%% coding.lang %%>'}" ng-model="editor.demodata"></div>
     <!--<pre id="editor" style="height:100%;" >  </pre> -->
     </div>

    </section>
    <footer>
        <button class="demo2" ng-click="codeSubmit()">제출</button>
    </footer>
    <?php echo e(HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js')); ?>

    
    <?php echo e(HTML::script('js/bower_components/ace-builds/src-min-noconflict/ace.js')); ?>

    <?php echo e(HTML::script('js/bower_components/angular-ui-ace/ui-ace.js')); ?>

    <!--
    <script src="https://pc035860.github.io/angular-highlightjs/angular-highlightjs.min.js"></script>
    -->
    <script>
        function codeSubmit(){
            document.getElementById('dialogshow').checked = !document.getElementById('dialogshow').checked;
        }
        function move(contid,targetid){
            var cls = document.getElementById(targetid);
            cls.parentElement.removeChild(cls);
            document.getElementById(contid).appendChild(cls);
            console.log("working");
        }
        var mobile=  window.matchMedia("screen and (max-width:767px)");
        var pc = window.matchMedia("screen and (min-width:768px)");
        function onChangedToMobileMode(mediaQuery){
            move("mobilecs","courseselector")
        }
        function onChangedToPcMode(mediaQuery){
            move("csloc","courseselector");
        }
       //mobile.addListener(onChangedToMobileMode);
       //pc.addListener(onChangedToPcMode);
       /* var editor = ace.edit("editor");
        editor.setTheme("ace/theme/twilight");
        editor.session.setMode("ace/mode/javascript");
        */
        hljs.initHighlightingOnLoad();
        //hljs.configure({useBR: true});
        hljs.initLineNumbersOnLoad();
  //SyntaxHighlighter.all();
    </script>
    <script>
    var pureScope = this;
     var sampleApp = angular.module('codingApp', ['ui.ace'/*,'hljs'*/], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%%');
        $interpolateProvider.endSymbol('%%>');
    });
    sampleApp.controller('MainCtrl',['$scope','$sce','$http',function($scope,$sce,$http){
    $scope.editor={demodata:"<html>\n<head><title>This is title</title></head>\n<body>\nHello world\n</body>\n</html>"
    };
    $scope.coding={lang:"html"};
    $scope.demo = {result_user:"result of user data"};
    $scope.submitResult = "";
    $scope.rawtxt2tHtml = function(data){
        return $sce.trustAsHtml(data);
    }
    $scope.rawlink2tURL = function(url){
        return $sce.trustAsResourceUrl(url);
    }
    $scope.makeIframeData=function(data){
        return  $scope.rawlink2tURL("data: text/html, "+$sce.trustAsHtml(data));
    }
    $scope.codeSubmit=function(){
        console.log("call codeSubmit");
        pureScope.codeSubmit();
        var param = {   
    id:"test",
    id_provider:"github",
    data: $scope.editor.demodata
};
        var lang = $scope.coding.lang;
        $http({
            method: 'POST' ,
            url: './codepage/api/'+lang,
            data: JSON.stringify( param),
            headers: {
                'Content-Type': 'application/json; charset=UTF-8'
            }
        }).then(function(response) {
            console.log(response);
            var dt = response.data;
             $scope.submitResult = dt.result_data;
             var userdt = dt.user;
             $scope.demo.result_user = ""+ userdt.success + userdt.point;
        },function (error){
            console.log(error);
   });

    }
    $scope.modeChanged = function(){
        var dt = $scope.navdata.courseSelect;
        if(dt=="HTML"){
            $scope.coding.lang = "html";
        }
        <?php 
        $output = array_map(function ($str) {
    return preg_replace('/[a-z]+/', '', $str);
        }, $examlist);
        for($i=1;$i<count($output);$i++){
             ?>
            else if(dt=="<?=$examlist[$i]?>"){
                $scope.coding.lang = "<?=strtolower($output[$i])?>";
            }
        <?php } ?>
    }
     }]);
    </script>
</body>
</html>