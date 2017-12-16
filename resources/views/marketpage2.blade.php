<!DOCTYPE <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
        {{--HTML::style('css/mainpage3.css')--}}
        {{HTML::style('css/marketpage2.css')}}
        {{HTML::style('css/nav_marketpage2.css')}}
        {{HTML::style('css/flex_layout.css')}}
        {{HTML::style('css/fluid_layout.css')}}
        {{HTML::style('css/show_hidden.css')}}
        
    </head>
    <body ng-app="marketApp" ng-controller="MainCtrl" data-ng-init="initApp()">
        <header>
            @include("mpgnav_marketpage")
        </header>
        <section class="content-view flex-layout-md flex-layout-md-horizontal flex-layout-lg flex-layout-lg-horizontal flex-layout-xlg flex-layout-xlg-horizontal">
            <div class="hidden-xsm hidden-sm flex-item-md-lv1 flex-item-lg-lv1 flex-item-xlg-lv1 shopcart">
                <div class="shopcart-title">
                   <span class="material-icons" style="font-size:11pt;">shopping_cart</span> 장바구니
				</div>
				<div class="shopcart-list">
					<ul>
                        <li ng-hide="shopcart.list.length">
                        장바구니가 비었습니다
                        </li>
						<li ng-repeat="x in shopcart.list">
							<p style="text-align:left;">
                            <%% x.title %%>
                            </p>
                            <p style="text-align:right;">
                                <%% x.price %%>
                            </p>
						</li>
					</ul>
				</div>
				<footer>
                    <div class="expectation-view">
                        <table>
                            <tr>
                                <td>선택강좌수</td>
                                <td><%% shopcart.list.length %%></td>
                            </tr>
                            <tr>
                                <td>총 가격</td>
                                <td><%% priceSum(shopcart.list) %%></td>
                            </tr>
                            <tr>
                                <td>현재 보유 코인수</td>
                                <td><%% userdata.coin %%></td>
                            </tr>
                            <tr>
                                <td>구매시 잔여 코인수</td>
                                <td> <%% calcCartResult(shopcart.list) %%></td>
                            </tr>
                        </table>
                    </div>
                    <div class="shopcart-controller">
                        <div class="flex-layout flex-layout-horizontal">
                            <button class="flex-item-lv1" ng-disabled="shopcart.list.length<=0" ng-click="clearCart()"><span style="font-size:11pt;" class="material-icons">remove_shopping_cart</span>
                            비우기
                            </button>
                            <button ng-disabled="shopcart.list.length<=0" ng-click="tryToPurchase()" class="flex-item-lv1">
                            구매하기
                            </button>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="flex-item-md-lv2 flex-item-lg-lv3 flex-item-xlg-lv3 market-list-view" style="position:relative;height:100%;">
                <div ng-init="detailpopupshow=false" ng-show="detailpopupshow" class="detail-content-popup">
                    <article class="detail-content-container">
                        <header>
                            <span ng-click="detailpopupshow=!detailpopupshow" class="material-icons"  style="float:right;cursor:pointer;">close</span>
                           상세정보
                        </header>
                        <section >
                            <table>
                                <tr>
                                    <td width="35%">강의명</td>
                                    <td width="65%"><%% detailviewmodel.title %%></td>
                                </tr>
                                <tr>
                                    <td>상세설명</td>
                                    <td><%% detailviewmodel.desc %%></td>
                                </tr>
                                <tr>
                                    <td>비용</td>
                                    <td><%% detailviewmodel.price %%></td>
                                </tr>
                                <tr>
                                    <td>프로그래밍<br>언어</td>
                                    <td><%% detailviewmodel.lang %%></td>
                                </tr>
                                <tr>
                                    <td>강좌상태</td>
                                    <td><%% detailviewmodel.purchased? '이미 구매함':'구매 하지 않음' %%></td>
                                </tr>
                                <tr>
                                    <td>상세설명</td>
                                    <td style="overflow-y:scroll;">
                                        <ul>
                                            <li ng-repeat="x in detailviewmodel.chapters"><%% x.title %%></li>
                                        </ul>
                                    </td>
                                </tr>
                                
                            </table>
                        </section>
                        <footer>

                        </footer>
                    </article>
                </div>
                <div class="course-content-view-wrapper">
                    <div class="course-content-view-toolbar">
                        <div class="course-content-view-toolbar-left-pad">
                            <div></div>
                        </div>
                        <div class="course-content-view-toolbar-container">
                            <button ng-click="refreshCourseList()" class="course-content-view-toolbar-button"><span class="material-icons">refresh</span>새로고침</button>
                        </div>
                        <div class="course-content-view-toolbar-right-pad">
                            <div></div>
                        </div>
                    </div>
                    <div class="course-content-view">
                        <div class="course-container">
                            <article ng-repeat="x in courselist" class=" course-item">
                                <header class="shopname">
                                    <label><%% x.title %%></label>
                                </header>
                                <div class="shopcont">
                                    <ul>
                                        <li ng-repeat="y in x.chapters"><%% y.title %%></li>
                                    </ul>
                                </div>
                                <footer>
                                    <div class="flex-layout flex-layout-horizontal">
                                    <button ng-click="viewDetailCourseContent(x)" class="flex-item-lv1"><span style="font-size:11pt;" class="material-icons">description</span>
                                    자세히보기
                                    </button>
                                    <button ng-disabled="isExistInCart(x)" ng-click="addToCart(x)" class="flex-item-lv1"><span style="font-size:11pt;" class="material-icons">add_shopping_cart</span>
                                    장바구니에 담기
                                    </button>
                                </div>
                                </footer>
                            </article>
                        
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer>
            <div style="position:relative;width:100%;height:inherit">
            <button class="full-width-button-with-padding hidden-md hidden-lg hidden-xlg">장바구니 보기</button>
            </div>
        </footer>
        {{HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js')}}        
        {{HTML::script('js/jquery-3.2.1.min.js')}}
        {{HTML::script('js/responsiveslides.min.js')}}
        <script>

        </script>
        <script >
            var pureScope = this;
            var sampleApp = angular.module('marketApp', [], function($interpolateProvider) {
                $interpolateProvider.startSymbol('<%%');
                $interpolateProvider.endSymbol('%%>');
            });
            sampleApp.controller('MainCtrl',['$scope','$sce','$http',function($scope,$sce,$http){
                $scope.ajaxRequest = function(all_param,successFunc,errorFunc){
                    $http(all_param).then(successFunc,errorFunc);
                };
                
                
                $scope.userdata = {coin:0};
                 $scope.courselist = [];
                 $scope.detailviewmodel={};
                $scope.shopcart = {list:[{title:"test123 lang",chash:"abcdef",price:77}],listcount:function(){return list.length;},pricesum:function(){
                    var rst = 0;
                    for(var i =0;i<list.length;i++){
                        rst += list[i].price;
                    }
                    return rst;
                }};
                $scope.loadUserData =  function(){
                     var requestConfig = {method:"GET",
        url:"./user/api/coin"};
                        $scope.ajaxRequest(requestConfig,function(resp){
                            var data = resp.data;
                            if(data.loaded){
                                $scope.userdata.coin = data.coin;
                                console.log("user data load ok");
                            }
                            else{
                                $scope.userdata.coin = 0;
                                console.log("user data load fail");
                            }
                        },function(error){
                            $scope.userdata.coin = 0;
                            console.log("user data load error");
                        });
                };
                $scope.loadAllMarketList = function(){
                    var requestConfig = {method:"GET",
        url:"./marketpage/api/alllist"};
                        $scope.ajaxRequest(requestConfig,function(resp){
                            var data = resp.data;
                            if(data.loaded){
                                data = data.data;
                                console.log(data);
                                var tmplst = [];
                                for(var i =0;i<data.length;i++){
                                    var tmp = {title:"unknown",desc:"",user_purchased:false,lang:"",chash:"unknown",rate:0,price:0,chapters:[]};
                                    var dt = data[i];
                                    tmp.title=dt.course_name;
                                    tmp.desc = dt.course_description;
                                    tmp.price = dt.cost;
                                    tmp.chash = dt.course_purchase_key;
                                    tmp.rate = dt.course_rate;
                                    tmp.user_purchased=dt.purchased;
                                    tmp.lang = dt.lang;
                                    var ches = [];
                                    for(var j=0;j<dt.chapters.data.length;j++){
                                        var chaps = dt.chapters.data[j];
                                        var tmpobj = {page:0,title:"unknown"};
                                        tmpobj.page = chaps.page;
                                        tmpobj.title=chaps.title_or_goal;
                                        ches.push(tmpobj);
                                    }
                                    tmp.chapters = ches;
                                    tmplst.push(tmp); 
                                }
                                $scope.courselist = tmplst;
                                console.log("courselst data load ok");
                            }
                            else{
                                $scope.courselist = [];
                                console.log("courselst data load fail");
                            }
                        },function(error){
                            $scope.courselist = [];
                            console.log("courselst data load error");
                        });
                };
                $scope.priceSum = function(list){
                    var rst = 0;
                    for(var i =0;i<list.length;i++){
                        rst += list[i].price;
                    }
                    return rst;
                };
                $scope.calcCartResult = function(list){
                    return $scope.userdata.coin - $scope.priceSum(list);
                }
                $scope.findItemFromArray = function(ary,compcallback){
                    var item = null;
                    for(var i=0;i<ary.length;i++){
                        if(compcallback(ary[i])){
                            item = ary[i];
                            break;
                        }
                    }
                    return item;
                }
                $scope.isExistInCart=function(x){
                    var arr = $scope.shopcart.list;
                    var chk = $scope.findItemFromArray(arr,function(ele){
                        return ele.chash===x.chash;
                    });
                    
                    return chk!=null;
                };
                $scope.removeFromCart = function(data){
                    
                };
                $scope.clearCart = function(){
                    $scope.shopcart.list = [];
                }
                $scope.addToCart = function(data){
                    //console.log(data);
                    var context = this;
                    console.log(context);
                    var arr = $scope.shopcart.list;
                    var chk = $scope.findItemFromArray(arr,function(ele){
                        return ele.chash===data.chash;
                    });
                    if(!chk){
                    arr.push(data);
                    }
                };
                $scope.tryToPurchase = function(){
                    var clist =$scope.shopcart.list;
                    if($scope.calcCartResult(clist)<0){
                        //pureScope.showMessage("코인이 부족하여 상품을 구매할 수 없습니다.");
                        $scope.initApp();
                    }
                    else{
                        var param = {course_purchase_keys:[]};
                        
                        for(var i = 0;i<clist.length;i++){
                            param.course_purchase_keys.push(clist[i].chash);
                        }
                        var requestConfig ={method:"POST",
                            url:"./marketpage/api/purchase",
                            data: JSON.stringify( param),
                                headers: {
                                    'Content-Type': 'application/json; charset=UTF-8'
                                }
                            };
                        $scope.ajaxRequest(requestConfig,function(resp){
                            var data = resp.data;
                            console.log(data);
                            if(data.loaded){
                                if(data.purchased){
                                    console.log("trypay success purchase");
                                    $scope.initApp();
                                }
                                else{
                                     console.log("trypay but fail to purchase");
                                }
                            }
                            else{
                                console.log("trypay but fail load");
                            }
                        },function(error){
                            console.log("trypay but error load");
                            console.log(error);
                        });
                    }
                };
                $scope.refreshCourseList = function(){
                    $scope.initApp();
                    
                };
                $scope.viewDetailCourseContent = function(data){
                    $scope.detailviewmodel = data;
                    $scope.detailpopupshow = true;
                };
                $scope.initApp = function(){
                    $scope.clearCart();
                    $scope.loadUserData();
                    $scope.loadAllMarketList();
                }
            }]);
        </script>
    </body>
</html>