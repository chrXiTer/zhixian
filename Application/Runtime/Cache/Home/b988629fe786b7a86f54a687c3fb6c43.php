<?php if (!defined('THINK_PATH')) exit();?><html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>知县 - 本县导航</title>
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


<div class="panel panel-success" style="margin-top:10px">
	<div class="panel-heading">
		<h3 class="panel-title">
			本县微信
			<a style="float:right" href="/Home/Main/SuggestSite">推荐站点</a>
		</h3>
	</div>
	<p class="panel-body">
		<a href="http://www.e0734.com/" target="_blank"><span class="label label-success">中国衡阳新闻网</span></a>
	</p>
</div>

<div class="panel panel-success" style="margin-top:10px">
	<div class="panel-heading">
		<h3 class="panel-title">
			本县网站
			<a style="float:right" href="/Home/Main/SuggestSite">推荐站点</a>
		</h3>
	</div>
	<p class="panel-body">
		<a href="http://www.hyxnews.com/" target="_blank"><span class="label label-success">衡阳县新闻网</span></a>
		<a href="http://www.hyxzx.net/" target="_blank"><span class="label label-success">衡阳县新闻网</span></a>
		<a href="http://www.hyx.gov.cn/" target="_blank"><span class="label label-success">衡阳县党政门户网</span></a>
		<a href="http://www.hyxez.com/" target="_blank"><span class="label label-success">县二中</span></a>
		<a href="http://www.hyxzz.com/" target="_blank"><span class="label label-success">县职业中专</span></a>
		<a href="http://www.hyx.org.cn/" target="_blank"><span class="label label-success">吉祥鸟工作室</span></a>
		<a href="http://www.cmbbyey.com/" target="_blank"><span class="label label-success">聪明宝贝幼儿园</span></a>
	</p>
</div>


<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title">
			本市本省网站
			<a style="float:right" href="/Home/Main/SuggestSite">推荐站点</a>
		</h3>
	</div>
	<p class="panel-body">
		<a href="http://www.e0734.com/" target="_blank"><span class="label label-success">中国衡阳新闻网</span></a>
		<a href="http://www.rednet.cn/" target="_blank"><span class="label label-success">红网</span></a>
	</p>
</div>

<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title">
			热门网站
			<a style="float:right" href="/Home/Main/SuggestSite">推荐站点</a>
		</h3>
	</div>
	<p class="panel-body">
		<a href="https://www.baidu.com/" target="_blank"><span class="label label-success">百度</span></a>
	</p>
</div>

<br/>
    </div><!--class="container body-content" -->
    <footer class="container body-content">
        <p>&copy; 2015 - 知县</p>
    </footer>

    <script src="/Public/jquery/jquery.js"></script>
    <script src="/Public/bootstrap335/js/bootstrap.js"></script>
</body>
</html>