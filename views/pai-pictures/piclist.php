<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--
    User: Cupid
    Date: 2016/10/21
    Time: 15:39
-->
<head>
	<?php use yii\helpers\Html;?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"  />

    <title>会议记录</title>
    <link rel="stylesheet" type="text/css" href="../views/css/commes.css" />
    <link rel="stylesheet" type="text/css" href="../views/css/listcommon.css" />
    <link rel="stylesheet" type="text/css" href="../views/css/module.css" />
    <link rel="stylesheet" type="text/css" href="../views/css/public.css" />
    <link rel="stylesheet" type="text/css" href="../views/css/photoswipe.css"/>
    <link rel="stylesheet" type="text/css" href="../views/css/default-skin/default-skin.css"/>
</head>
<body onLoad=Init();>

<!-- <p class="lead"><a  href="javascript:window.location.reload();"> 刷新 </a></p> -->

	<div class="side-bar" >
		<a onclick="chooseSheetPhoto()"></a>
	</div>
		<div class="list-group"></div>

<!--
		<div id="pullUp" onclick=getData();>
			<span class="pullUpIcon"></span><span class="pullUpLabel">点击加载更多...</span>
			<li class="list"></li>
		</div>
-->
<script>
	function chooseSheetPhoto(){
		var transferid = parseInt(new Date().getTime()/1000);
		NativeInteractive.chooseSheetPhoto({"webAppTransferID":transferid,"editType":0});
	}
	function OnChoosePhotoCb(datas){
		var status = datas.result.status,
			params = datas.result.params;
			if(status==0){
				var str_para = JSON.stringify(params);
// 				alert("upload回调函数OnUploadCb:"+str_para+"status:"+status);

				var setting = {
				"uploadUrl":"https://192.168.139.160:443/media_file/",
				"fileID":params.fileID,
				"fileName":params.fileName,
				"taskID":params.webAppTransferID||(new Date()).valueOf(),
				"nativePath":params.nativePath,
// 				"ownerID":"001"
			}
			NativeInteractive.uploadGivenFile(setting);
		}
	}
	function OnUploadGivenFileCb(datas){
		var status = datas.result.status,
			params = datas.result.params;
		if(params){
			var transferStatus = params.transferStatus;
			if(transferStatus=="Success"){
				var str_para = JSON.stringify(params);
// 				alert("OnUploadGivenFileCb 图片已上传:"+str_para);
				postData(params);
			}
		}

	}

//回传图片信息
	function postData(params){
		var length=0;
		$.ajax({
			type:'POST',
			url:'index.php?r=pai-pictures/upload',
			async:'false',
			data:{'params':params},
			dataType:'json',
			error:function(){
				alert('error');
			},
	   		success:function(datas){
// 		 		alert(JSON.stringify(datas));
		   		location.reload();
	   		},
	 		complete:function(){}
		});
	}
</script>

<script src="../views/js/native.js"></script>
<script src="../views/js/jquery.js"></script>
<script src="../views/js/foundation.min.js"></script>

<script>
//初始化fundation
	$(document).foundation();
</script>
<script>
	var $jq = jQuery.noConflict();
	var CurPage = 1; //当前页码
	var PageSize,TotalPage;
	var Page=2;
	var curTime="";
	var index=0;
	function Init(){
    	PageSize = <?=$pageSize?>; //每页显示条数
    	CurPage = 1; //当前页
    	TotalPage = <?=$totalPage?>; //总页数
		setView(<?=$data?>);
	}
	$jq(".tabs li").bind("click",function(){
		index=$jq(this).index();
			if(TotalPage-CurPage>0){
				$jq(".pullUpLabel").html("点击加载更多....");
			}else{
				$jq(".pullUpLabel").html("没有更多数据了...");
			}

	});
	function getData(){
		if(TotalPage-CurPage>0){
			CurPage+=1;
			getnewData(CurPage);
		}
		else{
			$jq(".pullUpLabel").html("没有更多数据了...");
		}

	}

	function getnewData(page){
		$jq.ajax({
	        type: 'GET',
	        url: 'index.php?r=pai-pictures/loadmore',
	        data: {'page':page-1},
	        dataType:'json',
	        afterSend:function(){
        	   $(".pullUpLabel").html("loading...");
	        },
	        success:function(json){
				dataApproval=json.data;
            	if(dataApproval!=null&&dataApproval.length>0){
            		setView(dataApproval);
            	}
            	else{
            		$jq(".pullUpLabel").html("没有更多数据了...");
            	}
        	},
        	complete:function(){ //生成分页条
        	},
        	error:function(){
        		$jq(".pullUpLabel").html("数据加载失败...");
        	}
    	});
	}
</script>
<script>
	function setView(dataList){
		var view="";
		$jq.each(dataList,function(index,data){
			view+="<div class='container'>";
			view+="<a class='listcontain' href='index.php?r=pai-pictures/detail&id="+data['fID']+"'>";
			view+="<div class='listcontain'>";
			view+="<li class='demo'>";
			view+="<div class='use'>";
			view+="<div class='usename'>";
			view+="<span>";
			view+=data['fUserName'];
			view+="<em class='pubtime'>";
			view+=data['fCreateTime'];
			view+="</em>";
			view+="</span>";
			view+="</div>";
			view+="</div>";
			view+="<p class='fx_content'>";
			view+=data['fDescription'];
			view+="</p>";
			view+="<div class='my-gallery'>";
			view+="<img src='"+data['fThumb']+"'/>";
			view+="</div>";
			view+="</li>";
			view+="</div>";
			view+="</a>";
			view+="</div>";

			});
		$jq(".list-group").append(view);
}
</script>

</body>
</html>