<!DOCTYPE <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
        
        <?php echo e(HTML::style('css/marketpage2.css')); ?>

        <?php echo e(HTML::style('css/nav_marketpage.css')); ?>

        <?php echo e(HTML::style('css/flex_layout.css')); ?>

        <?php echo e(HTML::style('css/fluid_layout.css')); ?>

        <?php echo e(HTML::style('css/show_hidden.css')); ?>

        
    </head>
    <body ng-app="marketApp" ng-controller="MainCtrl">
        <header>
            <?php echo $__env->make("mpgnav_marketpage", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                            <button class="flex-item-lv1"><span style="font-size:11pt;" class="material-icons">remove_shopping_cart</span></span>비우기
                            </button>
                            <button ng-disabled="shopcart.list.length<=0" class="flex-item-lv1">구매하기
                            </button>
                        </div>
                    </div>
                </footer>
            </div>
            <div class="flex-item-md-lv3 flex-item-lg-lv3 flex-item-xlg-lv3 market-list-view" style="overflow:scroll">
                <div class="course-container">
                    <article ng-repeat="x in demolist" class="demo course-item">
                        <header class="shopname">
                            <label><%% x.title %%></label>
                        </header>
                        <div class="shopcont">
                            <ul>
                                <li ng-repeat="y in x.content"><%% y %%></li>
                                
                            </ul>
                        </div>
                        <footer>
                            <div class="flex-layout flex-layout-horizontal">
                            <button class="flex-item-lv1"><span style="font-size:11pt;" class="material-icons">description</span>
                            자세히보기
                            </button>
                            <button ng-disabled="shopcart.list.length<=0" class="flex-item-lv1"><span style="font-size:11pt;" class="material-icons">add_shopping_cart</span>
                            장바구니에 담기
                            </button>
                        </div>
                        </footer>
                    </article>
                   
                </div>
            </div>
        </section>
        <footer>
        test
        </footer>
        <?php echo e(HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js')); ?>        
        <?php echo e(HTML::script('js/jquery-3.2.1.min.js')); ?>

        <?php echo e(HTML::script('js/responsiveslides.min.js')); ?>

        
        <script >
            var pureScope = this;
            var sampleApp = angular.module('marketApp', [], function($interpolateProvider) {
                $interpolateProvider.startSymbol('<%%');
                $interpolateProvider.endSymbol('%%>');
            });
            sampleApp.controller('MainCtrl',['$scope','$sce','$http',function($scope,$sce,$http){
                $scope.ajaxRequest = function(all_param,cmd,successFunc,errorFunc){
                    $http(all_param).then(successFunc,errorFunc);
                };
                $scope.loadAllMarketList = function(){

                };
                $scope.userdata = {coin:0};
                $scope.demodata = {title:"test title",chash:"1234567890",price:30};
                $scope.shopcart = {list:[$scope.demodata ,{title:"test123 lang",chash:"abcdef",price:77}],listcount:function(){return list.length;},pricesum:function(){
                    var rst = 0;
                    for(var i =0;i<list.length;i++){
                        rst += list[i].price;
                    }
                    return rst;
                }};
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
                $scope.demolist = [{title:'a',content:["a1","a2","a3"]},{title:'b',content:["b1","b2","b3"]},
                {title:'c',content:["c1","c2","c3"]},{title:'d',content:["d1","d2","d3"]},{title:'e',content:["e1","e2","e3","e4"]},{title:'f',content:["f1","f2"]}];
            }]);
        </script>
    </body>
</html>