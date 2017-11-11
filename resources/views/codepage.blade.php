<!DOCTYPE <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{HTML::style('css/codepage.css')}}
    {{HTML::style('css/show_hidden.css')}}
    {{HTML::style('css/flex_layout.css')}}
{{HTML::style('css/fluid_layout.css')}}
</head>
<body ng-app="codingApp" ng-controller="MainCtrl">
    <input type="checkbox" id="dialogshow" hidden></input>
    <div class="dialogwindow" >
        <section >
            <header class="flex-layout">
                <div class="flex-item-lv1" ><p>제출결과</p></div>
                <p class="dialog-button-close">
                <label for="dialogshow">X</label>
                </p>
            </header>
            <article class="dialog-content-area flex-layout-md flex-layout-md-horizontal flex-layout-lg flex-layout-lg-horizontal flex-layout-xlg flex-layout-xlg-horizontal">
                 <div class="demo flex-item-md-lv1 flex-item-lg-lv1  flex-item-xlg-lv1 "></div>
                <div class="demo flex-item-md-lv1 flex-item-lg-lv1 flex-item-xlg-lv1"></div>
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
            <li><div><p id="csloc"><select id="courseselector" ng-init="navdata.courseSelect = '<?=$examlist[0]?>'" ng-model="navdata.courseSelect">
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
     <div class="demo flex-item-md-lv3 flex-item-lg-lv3  flex-item-xlg-lv2 ">demo</div>
     <div class="demo flex-item-md-lv9 flex-item-lg-lv9 flex-item-xlg-lv10">
     <pre id="editor" style="height:100%;">function foo(items) {
    var i;
    for (i = 0; i &lt; items.length; i++) {
        alert("Ace Rocks " + items[i]);
    }
}</pre>
     </div>

    </section>
    <footer>
        <button class="demo2" onClick="document.getElementById('dialogshow').checked = !document.getElementById('dialogshow').checked;">제출</button>
    </footer>
    {{HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js')}}
    {{HTML::script('js/coding/aceeditor/src-noconflict/ace.js')}}
    <script>
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
        var editor = ace.edit("editor");
    editor.setTheme("ace/theme/twilight");
    editor.session.setMode("ace/mode/javascript");
    </script>
    <script>
    
     var sampleApp = angular.module('codingApp', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%%');
        $interpolateProvider.endSymbol('%%>');
        
    });
    sampleApp.controller('MainCtrl',['$scope',function($scope){
$scope.editor={demodata:"<html>\n<header><title>This is title</title></header>\n<body>\nHello world\n</body>\n</html>"};
     }]);
    </script>
</body>
</html>