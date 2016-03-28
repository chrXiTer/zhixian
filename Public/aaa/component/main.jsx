
require('./css/focus.css');
require('./css/textTitleList.css');
require('./css/FirstImgTextTitleList.css');
require('./css/GroupList.css');

var React = require('react');
var ReactDOM = require('react-dom');

import Focus from './Focus';
import TextTitleList from './TextTitleList';
import FirstImgTextTitleList from './FirstImgTextTitleList';
import GroupList from './GroupList';

var focusData = [
    {
        title:"运动控制：AI尚未完成的挑战",
        url:"http://www.guokr.com/article/441258/",
        imgUrl:"http://1.im.guokr.com/Szj8jklIYTwmb7K23ri-5y3K1LXJ2IXZX1X6UoVjwvJKAQAA6wAAAEpQ.jpg"
    },
    {
        title:"运动控制：AI尚未完成的挑战2",
        url:"http://www.guokr.com/article/441258/",
        imgUrl:"http://3.im.guokr.com/asrFPJTKDuLNJUdvwSiIHwthTRtStlpmlVcXFvdYAhVKAQAA3gAAAEpQ.jpg"
    }
]

var groupList = [
    {
        title:"水煮",
        introduction:"这是一个专门灌水、吐槽、版聊、无聊向的小组！",
        url:"http://www.guokr.com/group/376/",
        imgUrl:"http://3.im.guokr.com/zLn15aFZjxpMLKPIdYbTEj_v_hZDY1-9Gn5rbPDMO-OgAAAAoAAAAEpQ.jpg?imageView2/1/w/48/h/48"
    }
]

//主要内容，上推荐内容
ReactDOM.render(
    <Focus focusData={focusData}/>,
    document.getElementById('chrX_Fucos')
);

ReactDOM.render(
  <TextTitleList />,
  document.getElementById('chrX_TextTitleList')
);

//主要内容，下方普通内容

ReactDOM.render(
  <FirstImgTextTitleList />,
  document.getElementById('chrX_ImgTextTitleList1')
);

ReactDOM.render(
  <FirstImgTextTitleList />,
  document.getElementById('chrX_ImgTextTitleList2')
);

ReactDOM.render(
  <FirstImgTextTitleList />,
  document.getElementById('chrX_ImgTextTitleList3')
);

ReactDOM.render(
  <FirstImgTextTitleList />,
  document.getElementById('chrX_ImgTextTitleList4')
);


//侧栏组件

ReactDOM.render(
  <GroupList groupList={groupList}/>,
  document.getElementById('chrX_GroupList')
);


ReactDOM.render(
  <TextTitleList />,
  document.getElementById('chrX_TextTitleList21')
);

ReactDOM.render(
  <TextTitleList />,
  document.getElementById('chrX_TextTitleList22')
);

