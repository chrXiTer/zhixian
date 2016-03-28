import React from 'react';
const GroupList = ({groupList}) => {
    let items = [];
    groupList.map((item)=>{
        items.push(
            <GroupItem item={item} key={item.title}/>
        );
    })
    return (
        <ul className="chrx-group-list">
            {items}
        </ul>
    )
};

const GroupItem = ({item}) =>(
    <li>
        <a href={item.url} title={item.title} target="_blank" className="chrx-group-icon">
            <img width="48" height="48" src={item.imgUrl} alt={item.title} />
        </a>
        <div className="chrx-group-data">
            <h3>
                <a target="_blank" href={item.url}>{item.title}</a>
            </h3>
            <p className="chrx-group-info">{item.introduction}</p>
        </div>
    </li>
)

export default GroupList;  