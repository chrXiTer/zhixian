import React from 'react';
var ReactCSSTransitionGroup = require('react-addons-css-transition-group');

var SetIntervalMixin = {
  componentWillMount: function() {
    this.intervals = [];
  },
  setInterval: function() {
    this.intervals.push(setInterval.apply(null, arguments));
  },
  componentWillUnmount: function() {
    this.intervals.forEach(clearInterval);
  }
};

var FocusItem = React.createClass({
    render: function() {
        var item = this.props.focusItem;
        return (
                <figure key={item.title}>
                    <a href={item.url}  title={item.title} arget="_blank">
                        <img src={item.imgUrl} alt={item.title} />
                    </a>
                    <figcaption>
                        <a href={item.url}  title={item.title} target="_blank">
                            {item.title}
                        </a>
                    </figcaption>
                </figure>
        );
    }
})

var Focus = React.createClass({
    mixins: [SetIntervalMixin],
    getInitialState: function() {
        return {index: 0};
    },
    tick:function(){
        this.setState({index: (this.state.index + 1) % this.props.focusData.length});
    },
    changeImgByUser:function(e){
        this.setState({index:e.target.dataset.index});
    },
    componentDidMount: function() {
        this.setInterval(this.tick, 5000); // Call a method on the mixin
    },
    render: function() {
        var controlItems = [];
        var item =  this.props.focusData[this.state.index];
        this.props.focusData.map((function(item,index) {
            controlItems.push(
                <li className={index == this.state.index?"current": "cc"} 
                    key={index} onClick={this.changeImgByUser} data-index={index}></li>
            );
        }).bind(this));

        return (
            <div className="focus">
                <div className="focus-content">
                    <ReactCSSTransitionGroup transitionName="carousel" transitionEnterTimeout={300} transitionLeaveTimeout={300}>
                        <FocusItem focusItem={item} key={item.title} />
                    </ReactCSSTransitionGroup>
                </div>
                <ul className="focus-tag">
                    {controlItems}
                </ul>
            </div>
        );
  }
});

export default Focus;

