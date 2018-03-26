<?php
namespace Main\Controller;
use Think\Controller;
use Common\Common\AccountTool;

class EntertainmentController extends Controller {
    public function index(){
        $this->display();
    }
    public function GameList(){
        $this->gamesData = '[
            {name:"bmbmt", text:"斑马斑马跳", img:"games/bmbmt/icon"},
            {name:"blockgame", text:"合体积木", img:"games/blockgame/icon"},
            {name:"blfc", text:"暴力飞车", img:"games/blfc/icon"},
            {name:"blackjack", text:"21点", img:"games/blackjack/icon"},
            {name:"ai", text:"糖果丘比特", img:"games/ai/icon"},
            {name:"freekick", text:"任意球大师", img:"games/freekick/icon"},
            {name:"3dboxing", text:"3d拳击", img:"games/3dboxing/icon"},
            {name:"100c", text:"是男人就下100层", img:"games/100c/icon"},
            {name:"coreball", text:"coreball", img:"games/coreball/icon"},
            {name:"hgy", text:"画个圆", img:"games/hgy/icon"},
            
            {name:"dwlx", text:"动物连线", img:"games/dwlx/icon"},
            {name:"hjby", text:"火箭兔奔月", img:"games/hjby/icon"},
            {name:"feiyu", text:"小猪飞飞", img:"games/feiyu/icon"},
            {name:"xzhsdmx", text:"新召唤师峡谷冒险", img:"games/xzhsdmx/icon"},
            {name:"xxcbdwf", text:"炫炫翅膀带我飞", img:"games/xxcbdwf/icon"},
            {name:"ttxdszm", text:"天天炫斗", img:"games/ttxdszm/icon"},
            {name:"ttfc", text:"天天飞车", img:"games/ttfc/icon"},
            {name:"qsj", text:"枪神记", img:"games/qsj/icon"},
            {name:"minixd", text:"mini炫斗", img:"games/minixd/icon"},
            {name:"luoke", text:"洛克王国", img:"games/luoke/icon"},
            {name:"horsegame", text:"跳圈圈", img:"games/horsegame/icon"},
            {name:"dbj", text:"大宝剑", img:"games/dbj/icon"},
            {name:"cyb", text:"插月饼", img:"games/cyb/icon"},
            {name:"cbd", text:"抽绷带", img:"games/cbd/icon"}
        ]';
        //{name:"yd", text:"圆点", img:"games/yd/icon"},
        $this->display();
    }
    
    public function AllGameList(){
        $this->display();
    }
    
    public function Game(){
        $baseUrlFlag = I("path.3");
        
        $this->indexFileName = "index.html";
        if($baseUrlFlag == 0){
            $this->baseUrl = "http://chrx.sinaapp.com/static/game/ccg/games";
        }else if($baseUrlFlag == 1){
            $this->baseUrl = "http://zhxyx.sinaapp.com/ccgGameWXYZ";
        }else{
            $this->baseUrl = "http://zhxyx.sinaapp.com/ccf";
        }
        $this->gameName = I("path.2");
        $this->display();
    }
    
    public function ChatRoom(){
        $currentUser = AccountTool::getCurrentUser();
        if($currentUser === NULL){ 
            $returnUrl = $_SERVER['PATH_INFO'];
            $this->error("您还未登录，情先登陆", '/'."/Home/Account/Login?returnUrl=$returnUrl",3);
            return;
        }
        $this->token = AccountTool::getTokenToChatRoom();
        $this->display();
        
    }
}
?>