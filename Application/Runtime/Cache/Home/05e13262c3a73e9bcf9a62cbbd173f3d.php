<?php if (!defined('THINK_PATH')) exit();?><html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>知县 - 百科</title>
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

<div style="float:right">
	
</div>
<div class="panel panel-success" style="margin-top:10px">
	<div class="panel-heading">
		<h2 class="panel-title">
			<?php echo ($data["title"]); ?>
			<a style="float:right" href="/Home/Baike/Edit/<?php echo ($data["id"]); ?>">编辑</a>
			<a style="float:right;margin-right:10px" href="/Home/Baike/AllEntry/">所有条目</a>
		</h2>
	</div>
	<div class="panel-body">
		<?php echo ($data["content"]); ?>
	</div>
</div>

    </div><!--class="container body-content" -->
    <footer class="container body-content">
        <p>&copy; 2015 - 知县</p>
    </footer>

    <script src="/Public/jquery/jquery.js"></script>
    <script src="/Public/bootstrap335/js/bootstrap.js"></script>
</body>
</html>