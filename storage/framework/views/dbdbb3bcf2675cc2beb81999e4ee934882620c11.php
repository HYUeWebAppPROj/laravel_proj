<!DOCTYPE html>
<head lang="<?php echo e(app()->getLocale()); ?>">
	<!--
    <link href="123.css" rel="stylesheet" type="text/css" />
	-->
    <?php echo e(HTML::style('css/studypage.css')); ?>

     <?php echo $__env->make("mobileview.init", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script type="text/javascript">
	function initMoving(target, position, topLimit, btmLimit) {
		if (!target)
			return false;

		var obj = target;
		var initTop = position;
		var bottomLimit = Math.max(document.documentElement.scrollHeight, document.body.scrollHeight) - btmLimit - obj.offsetHeight;
		var top = initTop;

		obj.style.position = 'absolute';

		if (typeof(window.pageYOffset) == 'number') {
			var getTop = function() {
				return window.pageYOffset;
			}
		} else if (typeof(document.documentElement.scrollTop) == 'number') {
			var getTop = function() {
				return Math.max(document.documentElement.scrollTop, document.body.scrollTop);
			}
		} else {
			var getTop = function() {
				return 0;
			}
		}

		if (self.innerHeight) {
			var getHeight = function() {
				return self.innerHeight;
			}
		} else if(document.documentElement.clientHeight) {
			var getHeight = function() {
				return document.documentElement.clientHeight;
			}
		} else {
			var getHeight = function() {
				return 500;
			}
		}

		function move() {
			if (initTop > 0) {
				pos = getTop()-8;
			} else {
				pos = getTop() + getHeight() + initTop;
			}

			if (pos > bottomLimit)
				pos = bottomLimit;
			if (pos < topLimit)
				pos = topLimit;
			
			interval = top - pos;
			top = top - interval /5;
			obj.style.top = top + 'px';

			if(pos > initTop){
			window.setTimeout(function () {
			move();
			}, 0);
			}else{
			window.setTimeout(function () {
				move();
			}, 25);
			}
		}

		function addEvent(obj, type, fn) {
			if (obj.addEventListener) {
				obj.addEventListener(type, fn, false);
			} else if (obj.attachEvent) {
				obj['e' + type + fn] = fn;
				obj[type + fn] = function() {
					obj['e' + type + fn](window.event);
				}
				obj.attachEvent('on' + type, obj[type + fn]);
			}
		}

		addEvent(window, 'load', function () {
			move();
		});
	}


			function initScrollContent(container, prevBtn, nextBtn) {
			var currentContentPage = 1;
			var contentElCount = 0;
			var content_x = 0;
			var slideContentTo = 0;
			var contentWidth = 685;
			var isImageBtn = true;
			var cont = container.getElementsByTagName("div");

			for (i=0; i<cont.length; i++) {
				if (cont[i].className == "slideContent") {
					contentElCount++;
					cont[i].style.left = contentWidth * (contentElCount - 1) + "px";
				}
			}

			setSlideBtn();

			function setSlideBtn() {
				if (contentElCount == 1) {
					setPrevBtn("off");
					setNextBtn("off");
				} else if (parseInt(currentContentPage) == 1) {
					setPrevBtn("off");
					setNextBtn("on");
				} else if (parseInt(currentContentPage) == contentElCount) {
					setPrevBtn("on");
					setNextBtn("off");
				} else {
					setPrevBtn("on");
					setNextBtn("on");
				}
			}
			function setPrevBtn(condition) {
				if (condition == "on") {
					prevBtn.onclick = viewPrev;
					if (isImageBtn) prevBtn.src = prevBtn.src.replace("_off.gif", ".gif");
					prevBtn.className = prevBtn.className.replace(" off", "");
					prevBtn.className += " on";
				} else {
					prevBtn.onclick = "";
					if (isImageBtn) prevBtn.src = prevBtn.src.replace(".gif", "_off.gif");
					prevBtn.className = prevBtn.className.replace(" on", "");
					prevBtn.className += " off";
				}
			}
			function setNextBtn(condition) {
				if (condition == "on") {
					nextBtn.onclick = viewNext;
					if (isImageBtn) nextBtn.src = nextBtn.src.replace("_off.gif", ".gif");
					nextBtn.className = nextBtn.className.replace(" off", "");
					nextBtn.className += " on";
				} else {
					nextBtn.onclick = "";
					if (isImageBtn) nextBtn.src = nextBtn.src.replace(".gif", "_off.gif");
					nextBtn.className = nextBtn.className.replace(" on", "");
					nextBtn.className += " off";
				}
			}
			function viewPrev() {
				slideContentTo += contentWidth;
				currentContentPage = parseInt(currentContentPage) - 1;
				setSlideBtn();
				startScroll();
			}
			function viewNext() {
				slideContentTo -= contentWidth;
				currentContentPage = parseInt(currentContentPage) + 1;
				setSlideBtn();
				startScroll();
			}
			function startScroll() {
				setTimeout(
					function slideContent() {
						if (Math.abs(content_x - slideContentTo) > 1) {
							content_x += (slideContentTo - content_x) * .15;
							container.style.left = content_x + "px";
							startScroll();
						} else {
							content_x = slideContentTo;
							container.style.left = content_x + "px";
						}
					}

				, 10);
			}
		}
</script>

	<title>코딩교육</title>
</head>
<body>
	<div id="tim">
		<div class="header">
			<div class="wrap">
				<h1>
					<a href="#">코딩교육</a>
				</h1>
				<div class="top">
					<ul class="rt">
						<li><a class="rtlink" href="#">Log In</a></li>
					</ul>
				</div>
				<div id="topmenu">
					<ul class="menu">
						<li><a class="menulink">html</a></li>
						<li><a class="menulink">css</a></li>
						<li><a class="menulink">javascript</a></li>
						<li><a class="menulink">live coding</a></li>
						<li><a class="menulink">market</a></li>
						<li><a class="menulink">my page</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div id="head">    <!--슬라이드내용-->
			<div class="gallery-container">
			<div class="slideContentContainer">
				<div id="gmnextslide" class="slideContentMover">
					<div class="slideContent">
						<ul>
							<li><a href="1.jpg"><img src="<?php echo e(asset($imgpath.'/1.jpg')); ?>" alt="1918 Royal Cadillac" /></a></li>
							<li><a href="2.jpg"><img src="<?php echo e(asset($imgpath.'/2.jpg')); ?>" alt="1918 Royal Cadillac" /></a></li>
							<li><a href="3.jpg"><img src="<?php echo e(asset($imgpath.'/3.jpg')); ?>" alt="Winstorm" /></a></li>
							<li><a href="4.jpg"><img src="<?php echo e(asset($imgpath.'/4.jpg')); ?>" alt="Winstorm" /></a></li>
						</ul>
					</div>
					<div class="slideContent">
						<ul>
							<li><a href="1.jpg"><img src="<?php echo e(asset($imgpath.'/1.jpg')); ?>" alt="1918 Royal Cadillac" /></a></li>
							<li><a href="2.jpg"><img src="<?php echo e(asset($imgpath.'/2.jpg')); ?>" alt="1918 Royal Cadillac" /></a></li>
							<li><a href="3.jpg"><img src="<?php echo e(asset($imgpath.'/3.jpg')); ?>" alt="Winstorm" /></a></li>
							<li><a href="4.jpg"><img src="<?php echo e(asset($imgpath.'/4.jpg')); ?>" alt="Winstorm" /></a></li>
						</ul>
					</div>
					<div class="slideContent">
						<ul>
							<li><a href="1.jpg"><img src="<?php echo e(asset($imgpath.'/1.jpg')); ?>" alt="1918 Royal Cadillac" /></a></li>
							<li><a href="2.jpg"><img src="<?php echo e(asset($imgpath.'/2.jpg')); ?>" alt="1918 Royal Cadillac" /></a></li>
							<li><a href="3.jpg"><img src="<?php echo e(asset($imgpath.'/3.jpg')); ?>" alt="Winstorm" /></a></li>
							<li><a href="4.jpg"><img src="<?php echo e(asset($imgpath.'/4.jpg')); ?>" alt="Winstorm" /></a></li>
						</ul>
					</div>
					<div class="slideContent">
						<ul>
							<li><a href="1.jpg"><img src="<?php echo e(asset($imgpath.'/1.jpg')); ?>" alt="1918 Royal Cadillac" /></a></li>
							<li><a href="2.jpg"><img src="<?php echo e(asset($imgpath.'/2.jpg')); ?>" alt="1918 Royal Cadillac" /></a></li>
							<li><a href="3.jpg"><img src="<?php echo e(asset($imgpath.'/3.jpg')); ?>" alt="Winstorm" /></a></li>
							<li><a href="4.jpg"><img src="<?php echo e(asset($imgpath.'/4.jpg')); ?>" alt="Winstorm" /></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="slideBtnSet">
				<img id="gmnextprev" class="prevbtn" src="<?php echo e(asset($imgpath.'/prev.jpg')); ?>" alt="prev">
				<img id="gmnextnext" class="nextbtn" src="<?php echo e(asset($imgpath.'/next.jpg')); ?>" alt="next">
			</div>
		</div>

		<script type="text/javascript">
			var bool1 = true;            //슬라이드형식 활성화 비활성화 (true면 활성화)
			if(bool1 == true){
				initScrollContent(document.getElementById("gmnextslide"), document.getElementById("gmnextprev"), document.getElementById("gmnextnext"));
			}
		</script>
	</div>
	<script type="text/javascript">
		var bool = true;                 //메뉴바 활성화 비활성화 (true면 활성화)
		if(bool == true)
			initMoving(document.getElementById("topmenu"), 100, 100, 100);
	</script>
</body>

</html>