<<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;" />
<title>Pull to Refresh</title>
<style>
div{
    position: absolute;
    top:0px;
    bottom:0px;
    width:100%;
    left:0px;
    overflow: hidden;
}
li{
    list-style-type: none;
    height:35px;
    background: #ccc;
    border-bottom: solid 1px #fff;
    text-align: left;
    line-height: 35px;
    padding-left:15px;
}
ul{
    width:100%;
    margin-top:0px;
    position: absolute;
    left:0px;
    padding:0px;
    top:0px;
}
</style>
</head>
<body>
<!-- <p class="lead"><a  href="javascript:window.location.reload();"> 刷新 </a></p> -->

<div class="outerScroller">
    <ul class = "scroll">
    <p class="lead"><a  href="javascript:window.location.reload();"> 刷新 </a></p>

        <li>1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
        <li>5</li>
        <li>6</li>
        <li>7</li>
        <li>8</li>
        <li>9</li>
        <li>10</li>
<!--         <li>1</li> -->
<!--         <li>2</li> -->
<!--         <li>3</li> -->
<!--         <li>4</li> -->
<!--         <li>5</li> -->
<!--         <li>6</li> -->
<!--         <li>7</li> -->
<!--         <li>8</li> -->
<!--         <li>9</li> -->
<!--         <li>10</li> -->
    </ul>
</div>
<script >
   var scroll = document.querySelector('.scroll');
   var outerScroller = document.querySelector('.outerScroller');
   var touchStart = 0;
   var touchDis = 0;
   outerScroller.addEventListener('touchstart', function(event) {
        var touch = event.targetTouches[0];
        // 把元素放在手指所在的位置
           touchStart = touch.pageY;
           console.log(touchStart);
        }, false);
   outerScroller.addEventListener('touchmove', function(event) {
        var touch = event.targetTouches[0];
        console.log(touch.pageY + 'px');
        scroll.style.top = scroll.offsetTop + touch.pageY-touchStart + 'px';
        console.log(scroll.style.top);
        touchStart = touch.pageY;
        touchDis = touch.pageY-touchStart;
        }, false);
   outerScroller.addEventListener('touchend', function(event) {
        touchStart = 0;
        var top = scroll.offsetTop;
        console.log(top);
        if(top>70)refresh();
        if(top>0){
            var time = setInterval(function(){
              scroll.style.top = scroll.offsetTop -2+'px';
              if(scroll.offsetTop<=0)clearInterval(time);
            },1)
        }
    }, false);
   function refresh(){
// 	   javascript:window.location.reload();
    for(var i = 10;i>0;i--)
        {
            var node = document.createElement("li");
            node.innerHTML = "I'm new";
            scroll.insertBefore(node,scroll.firstChild);
        }

   }
</script>

</body>
</html>