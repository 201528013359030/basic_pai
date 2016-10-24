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
<body>
<?php foreach ($model as $mod){?>
	<div class="container">
    <!--用户头像 预留位置-->
    <!--
    <div class="header">
       <div><img src="images/1.jpg" /></div>
    </div>
    -->
    
        <?= Html::beginTag('a',['class'=>'listcontain','href'=>''.$mod['fID']])?>
            <div class="listcontain">
                 <div class="demo">
                    <!--用户名and发布时间-->
                    <div class="use">
                         <div class="usename"><span><?=Html::encode($mod['fUserName']) ?></span><em class="pub-time"><?=Html::encode($mod['fCreateTime']) ?></em></div>
                    </div>
                    <!--分享的内容-->
                    <p class="fx_content"><?=Html::encode($mod['fDescription']) ?></p>
                     <!--分享的图片-->
                     <div class="my-gallery">
                     <!--   <img src="images/2.jpg" /> -->
                     	<?= Html::img($mod['fThumb']);?>
                     </div>
                 </div>
            </div>
        <?=Html::endTag('a')?>
	</div>
<?php }?>
    
<div class="side-bar" > 
	<a onclick="chooseSheetPhoto()"></a> 
</div>
    
   


<script src="../views/js/native.js"></script>
<script src="../views/js/jquery.js"></script>

<script>
// $(document).ready(function(){
// 	$("button").click(function(){
// 		postData('1');

// 	});
// 	});

function chooseSheetPhoto(){
	var transferid = parseInt(new Date().getTime()/1000);
	NativeInteractive.chooseSheetPhoto({"webAppTransferID":transferid,"editType":1});
}
function OnChoosePhotoCb(datas){
	var status = datas.result.status,
		params = datas.result.params;
		if(status==0){
			var str_para = JSON.stringify(params);
			alert("upload回调函数OnUploadCb:"+str_para+"status:"+status);

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
			alert("OnUploadGivenFileCb 图片已上传:"+str_para);
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
// 			$.alert({
// 				title:'提示信息',
// 				content:"出错了.....",
// 				confirmButton:'确认'
// 				});
			},
	   success:function(datas){
		   alert(JSON.stringify(datas));
		   location.reload();
	   },
	 complete:function(){
				}
		});
	}
</script>
</body>
</html>