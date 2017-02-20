function removeLogoEyes(e){
    //鼠标相对于body的位置
    var mouse = new Object();
    mouse.x = e.clientX;
    mouse.y = e.clientY;
    var center = getDivPosition("logo");

    var ang = angle(mouse,center);
    var xt= Math.cos(ang);
    var yt= Math.sin(ang);
    //左边眼镜参数
    var left = getDivPosition("left_glass");
    var leftWidth = document.getElementById("left_glass").offsetWidth * 0.25;
    //右边眼镜参数
    var right = getDivPosition("right_glass");
    var rightWidth = document.getElementById("right_glass").offsetWidth * 0.25;

    //判断以如果以center为原点,鼠标所处的象限
    if(mouse.x > center.x){
        if(mouse.y > center.y){
            //第一象限
            document.getElementById("left_eye").style.left = (left.x + xt * leftWidth)+"px";
            document.getElementById("left_eye").style.top = (left.y + yt * leftWidth)+"px";
            document.getElementById("right_eye").style.left = (right.x + xt * rightWidth)+"px";
            document.getElementById("right_eye").style.top = (right.y + yt * rightWidth)+"px";
        }else{
            //第二象限
            document.getElementById("left_eye").style.left = (left.x + xt * leftWidth)+"px";
            document.getElementById("left_eye").style.top = (left.y + yt * leftWidth)+"px";
            document.getElementById("right_eye").style.left = (right.x + xt * rightWidth)+"px";
            document.getElementById("right_eye").style.top = (right.y + yt * rightWidth)+"px";
        }
    }else{
        if(mouse.y > center.y){
            //第四象限
            document.getElementById("left_eye").style.left = (left.x - xt * leftWidth)+"px";
            document.getElementById("left_eye").style.top = (left.y - yt * leftWidth)+"px";
            document.getElementById("right_eye").style.left = (right.x - xt * rightWidth)+"px";
            document.getElementById("right_eye").style.top = (right.y - yt * rightWidth)+"px";
        }else{
            //第三象限
            document.getElementById("left_eye").style.left = (left.x - xt * leftWidth)+"px";
            document.getElementById("left_eye").style.top = (left.y - yt * leftWidth)+"px";
            document.getElementById("right_eye").style.left = (right.x - xt * rightWidth)+"px";
            document.getElementById("right_eye").style.top = (right.y - yt * rightWidth)+"px";
        }
    }
    if( mouse.x < center.x + 50 && mouse.x > center.x - 50 && mouse.y < center.y + 50 && mouse.y > center.y - 50){
        document.getElementById("left_eye").style.left = left.x +"px";
        document.getElementById("left_eye").style.top = left.y +"px";
        document.getElementById("right_eye").style.left = right.x +"px";
        document.getElementById("right_eye").style.top = right.y +"px";
    }
}
//求两点之间直线与水平的夹角
function angle(start,end){
    var diff_x = end.x - start.x,
        diff_y = end.y - start.y;
    //弧度
    return Math.atan(diff_y/diff_x);
}
//获取div中心点坐标
function getDivPosition(divObj){
    if(typeof divObj == 'string'){
        divObj=document.getElementById(divObj);
    }
    return {"x":divObj.offsetLeft + (divObj.clientWidth/2),"y":divObj.offsetTop + (divObj.clientWidth/2)};
}
//控制菜单打开隐藏
function menuCollspan(){
    if($("#menu").is(":visible")==false){
        $("#menu").show(100);
    }else{
        $("#menu").hide(100);
    }
}
