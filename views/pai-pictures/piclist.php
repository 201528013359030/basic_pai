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
	<script src="../views/js/native.js"></script>
	<script src="../views/js/jquery.js"></script>
	<script src="../views/js/foundation.min.js"></script>


</head>
<body onLoad=Init();>
	<div class="off-canvas-wrap" data-offcanvas>
		<div class="inner-wrap">
			<div id="scrollwrap">
				<div id="scroller">
					<div class="tabs-content">
						<div class="content active" id="panel1">
							<div class="list-group"></div>
						</div>
					</div>
					<!--tabs-content-->
					<div id="pullUp" onclick=getData();>
						<span class="pullUpIcon"></span><span class="pullUpLabel">点击加载更多...</span>
						<li class="list"></li>
					</div>
				</div>
				<!--end scroller-->
			</div>
		</div>
	</div>
	<div class="side-bar" > 
		<a onclick="chooseSheetPhoto()"></a> 
	</div>

<script>
	function chooseSheetPhoto(){
		var transferid = parseInt(new Date().getTime()/1000);
		NativeInteractive.chooseSheetPhoto({"webAppTransferID":transferid,"editType":1});
	}
	function OnChoosePhotoCb(datas){
		var status = datas.result.status,
			params = datas.result.params;
			if(status==0){
				var str_para = JSON.stringify(params);
			//	alert("upload回调函数OnUploadCb:"+str_para+"status:"+status);

				document.getElementById("tip_choosephoto").style.display = "inline-block";
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
				document.getElementById("tip_choosephoto").style.display = "none";
				var str_para = JSON.stringify(params);
			//	alert("OnUploadGivenFileCb 图片已上传:"+str_para);
				postData(params);
			}
		}
	}

//获取左面数据
	function postData(params){
		var length=0;
		$.ajax({
			type:'POST',
			url:'index.php?r=pai-pictures/create',
			async:'false',
			data:{'params':params},
			dataType:'json',
			error:function(){
				alert('error');
			},
	   		success:function(datas){
		 		alert(JSON.stringify(datas));
		   		location.reload();
	   		},
	 		complete:function(){}
		});
	}
</script>

<script>
//初始化fundation
	$(document).foundation();
</script>
<script>
	var $jq = jQuery.noConflict();
	var CurPage = 1; //当前页码
	var Total,PageSize,TotalPage;
	var Page=2;
	var curTime="";
	var index=0;
	function Init(){
		Total = <?=$Total?>; //总记录数
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
	        url: 'index.php?r=pai-pictures/loadMore',
	        data: {'page':page-1,'pageSize':PageSize},
	        dataType:'json',
	        afterSend:function(){
        	   $(".pullUpLabel").html("loading...");
	        },
	        success:function(json){
				dataApproval=json.dataApproval;
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
			view+="<a class='listIteam' href=''>";
			view+="<i class='icon ic_shi'>事</i>";
			view +="<i class='ficon icon-angle-right'></i>";
			view+="<p class='info clearfix'>";
			view+="<span class='fl name'>";
			view +=data['days'];
			view +="天</span>";
			view +="<span class='fr status'>";
			view+="<em class='fc_sucess'>审批中</em>";
			view +="</span>";
			view +="</p>";
			view +="<p class='info clearfix'>";
			view +="<span class='fl summary textCut'>";
			view+=data['reason'];
			view+="</span>";
			view+="<span class='fr date'>";
			view+=data['applyTime'];
			view+="</span>";
			view+="</p>";
			view+="</a>";

			});
		$jq("#panel1 .list-group").append(view);
}
</script>

</body>
</html>