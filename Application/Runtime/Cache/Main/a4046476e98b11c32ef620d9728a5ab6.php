<?php if (!defined('THINK_PATH')) exit();?>    <html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>知县 - 主页</title>
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
    
    <div id="all">            
    <div class="main">
        <div class="recommend">
            <h1>精华推荐</h1>
            <div id="chrX_Fucos">放置轮播图片</div>
            <div id="chrX_TextTitleList">轮播图片右边的推荐文章列表</div>
        </div>
        
        <div class="contents">
            <h1>档案</h1>
            <div class="content">
                <h2 class="content-title">故事</h2>
                <div id="chrX_ImgTextTitleList1">与县有关的故事</div>
            </div>
            <div class="content">
                <h2 class="content-title">知识</h2>
                <div id="chrX_ImgTextTitleList2">与县有关的故事</div>
            </div>
        </div>
        <div class="contents">
            <h1>人物</h1>
            <div class="content">
                <h2 class="content-title">网络红人</h2>
                <div id="chrX_ImgTextTitleList3">与县有关的网络红人</div>
            </div>
            <div class="content">
                <h2 class="content-title">动向</h2>
                <div id="chrX_ImgTextTitleList4">与县有关的社会动向</div>
            </div>
        </div>
    </div>
    
    <aside class="side">
        <div class="side-title">
            <h2>热门县</h2>
            <div id="chrX_GroupList">热门县</div>
        </div>
        
        <div class="side-title-border">
            <h2>子站热点</h2>
            <div id="chrX_TextTitleList21">子站热点</div>
        </div>
        
        <div class="side-title-border">
            <h2>知县专区</h2>
            <div id="chrX_TextTitleList22">知县专区</div>
        </div>

        <div class="side-link">
            <a id="weixin" href="javascript:void(0)">关注微信公众号</a>
            <img id="weixinQcode" src="http://static.guokr.com/skin/imgs/dimensions-code.jpg?v=unknown"
            style="width:90%;visibility:hidden"/>
        </div>
    </aside>
    </div>
<script src="/Public/aaa/build/main.js"></script>
<link rel="stylesheet" href="/Public/css/Main/Main/main.css">
<script>
    var weixinButtonE = document.getElementById("weixin");
    var weixinQcodeE = document.getElementById("weixinQcode");
    var weixinQcodeDisplay = "visible";
    weixinButtonE.onclick = function(){
        weixinQcodeE.style.visibility = weixinQcodeDisplay;
        weixinQcodeDisplay = weixinQcodeDisplay == "visible"? "hidden": "visible";
    }
</script>

    </div><!--class="container body-content" -->
    <footer class="container body-content">
        <p>&copy; 2015 - 知县</p>
    </footer>

    <script src="/Public/jquery/jquery.js"></script>
    <script src="/Public/bootstrap335/js/bootstrap.js"></script>
</body>
</html>