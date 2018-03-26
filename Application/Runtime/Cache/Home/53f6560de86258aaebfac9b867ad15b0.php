<?php if (!defined('THINK_PATH')) exit();?><html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>知县 - 新鲜分享</title>
        <link rel="stylesheet" href="/Public/bootstrap335/css/bootstrap.css" />
        <link rel="stylesheet" href="/Public/css/site.css" />
    </head>
    <body>
        <div class="container body-content"> 
<div id="chrx-menu" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" id="goBack" type="button" style="display:none" onclick="history.go(-1);return false" >⬅️</a>
            <a class="navbar-brand" href="/Main/Main">知县</a>
            <a class="navbar-brand" href="/Main/Entertainment">休闲娱乐</a>
            <a class="navbar-brand" href="/Main/News">新鲜分享</a>
        </div>
        
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a class="navbar-brand" style="font-size:12px" href="/Home/Main"><?php echo C('COUNTY_NAME')?></a></li>
                <li><a class="navbar-brand" style="font-size:12px" href="/Home/Main/Navigation">本县导航</a></li>
                <li><a class="navbar-brand" style="font-size:12px" href="/Home/News">本地分享</a></li>
                <li><a class="navbar-brand" style="font-size:12px" href="/Home/Baike">本地百科</a></li>
            </ul>
            
        </div>
    </div>
</div>

<script>
function isWeiXin(){
    var ua = window.navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i) == 'micromessenger'){
        return true;
    }else{
        return false;
    }
}
var goBackE = document.getElementById("goBack");
if(isWeiXin())
</script> 
<style>
.remove-flag{
	position:relative;
	top: 1px;
	left:1px;
	display: none;
}
</style>
<div class="panel panel-success" style="margin-top:10px">
	<div class="alert alert-success" style="margin-bottom:0px" role="alert">
		<h2 class="panel-title">
			新鲜分享
			<?php if($isLogin){ ?>
				<a style="float:right" href="/Home/News/MyNews">我的分享</a>
				<a style="float:right;margin-right:6px" href="/Home/News/AddANews">添加分享</a>
				<a id="managmentItem" style="float:right;margin-right:6px" href="#">管理</a>
			<?php }else{ ?>
				<a style="float:right" href="/Home/Account/Login?returnUrl=/Home/News">登录后可添加分享</a>
			<?php } ?>
		</h2>
	</div>
	<ul class="list-group">
	<?php foreach($newsList as $index => $news){ $classStr = "list-group-item-default" ?>			
		<li class="list-group-item <?php echo ($classStr); ?>">
			<a href="/Home/News/DisplayANews/<?php echo ($news["id"]); ?>"><?php echo ($news["title"]); ?></a>
			<span class="glyphicon glyphicon-remove remove-flag" id="removeFlag<?php echo ($news["id"]); ?>"></span>
		</li>
	<?php } ?>
	</ul>
</div>

<script>
function GRemoveSAN(){
	var managmentItem = function(calledActionInUrl){
		var removeFlagEs = document.getElementsByClassName("remove-flag");
		for(var i=0; i < removeFlagEs.length; i++){
			removeFlagEs[i].style.display = "inline";
			var idStr = removeFlagEs[i].id.replace("removeFlag","");
			
			;(function(){
				var idInt = parseInt(idStr); //用闭包保存变量
				removeFlagEs[i].onclick = function(){
					removeAItem(idInt, calledActionInUrl);
				}	
			})();
		}
	}

	function removeAItem(idInt, calledActionInUrl){	
		var xhr = new XMLHttpRequest();
		xhr.open("POST", "/Home/Api/" + calledActionInUrl + "/" + idInt);
		xhr.send('{"id": "'+ idInt +'"}');
		xhr.onload = function(e){
			var responseObj = JSON.parse(xhr.responseText);
			if(responseObj.status && responseObj.status == "ok"){
				removeAItemFromPage(idInt);
			}
		}
	}
	
	function removeAItemFromPage(idInt){
			var id = "removeFlag" + idInt;
			var item = document.getElementById(id);
			item.parentElement.remove();
	}

	var normalDisplayFunc = function(){
		var removeFlagEs = document.getElementsByClassName("remove-flag");
		for(var i=0; i < removeFlagEs.length; i++){
			removeFlagEs[i].style.display = "none";
		}
	}

	this.getClickCallBack = function(url){
		var linkStatus = "管理";
		var clickCallBack = function(e){
			if(linkStatus == "管理"){
				managmentItem(url);
				e.target.innerText = "正常显示";
				linkStatus = "正常显示";
			}else{
				normalDisplayFunc();
				e.target.innerText = "管理";
				linkStatus = "管理";
			}
			return false;
		}
		return clickCallBack;
	}
}
</script>
<script>
	var managmentItemE = document.getElementById("managmentItem");
	managmentItemE.onclick = new GRemoveSAN().getClickCallBack("DeleteANewsById");
</script>

    </div><!--class="container body-content" -->
    <footer class="container body-content">
        <p>&copy; 2015 - 知县</p>
    </footer>

    <script src="/Public/jquery/jquery.js"></script>
    <script src="/Public/bootstrap335/js/bootstrap.js"></script>
</body>
</html>