
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta id="viewport" name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<title>native交互接口测试页面</title>
<style>
*{padding:0;margin:0;}
html,body{font-size: 12; color:#333;}
body{padding-top:.875rem;}

.lead{line-height: 1.5; text-align: center; color:#878787;}
.btnBox{width:90%; margin:0 auto; margin-bottom:.875rem;}
.button{width:100%;  line-height: 1.5; font-size: 18px; text-align: center; border:1px #d7d7d7 solid; background:#f0f0f0; outline: rgba(0,0,0,0);}
.sel{width:100%; height:2rem; line-height: 1.5; font-size: 18px; text-align: center; border:1px #d7d7d7 solid; background:#f0f0f0; outline: rgba(0,0,0,0);}
.showWindow{ width:80%; background:#f7f7f7; padding:10px; margin:0 auto;}

.grid-3{ width:32%;}
.grid-4{ width:23%;}
.grid-5{ width:48%;}
.grid-6{ width:60%;}
.grid-7{ width:73%;}
</style>

<!--引入native.js 进行调用-->
<script src="../views/js/native.js"></script>
</head>
<body>
<p class="lead"><a  href="javascript:window.location.reload();"> 刷新 </a></p>
<br>

<!--*
* @ chooseSheetPhoto 选择图片，裁剪并上传
* @ param 参数
* webAppTransferID 唯一标识
* chooseType 默认"ChooseFromActionSheet"表示上拉菜单/弹出框选择
* editType 默认0 为不裁剪  1 为裁剪
* photoRatio 裁剪比例   1为正方形
* 其他参数参见交互文档
*
* OnChoosePhotoCb 返回参数参加文档
*
-->


<div class="btnBox">
	<button class="button button-xs" onclick="chooseSheetPhoto();">选择照片<span id="tip_choosephoto" style="display: none;">(上传中需等待)</span></button>
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
		}
	}
}

</script>

<!--**
* @下载接口
* @ param
* fileName	文件名	是
fileID	文件唯一标识	是
taskID	任务唯一标识 （服务器端构造，用于将文件和任务进行关联）
size	文件大小
path	文件所在的服务器端的路径
isAutoDownload	自动下载	    0为不自动下载    1为自动下载
isAutoPreView	下载后自动预览	0为不自动预览     1为自动预览
uploader	上传者名称          (可选)
uploadTime	上传时间              (可选)
不同于时间戳，为格式化显示时间	(可选)
*
-->
<div class="btnBox">
	<button class="button button-xs" onclick="download();">文件下载</button>
</div>
<script>
function download(){
	var parameter = {"fileName":"HelloWorld.txt",
		"fileID":"b21a26c9325e0daa04ddd90f32b0f88b",
		"taskID":"task150803casq5509",
		"size":"125",
		"path": "https://192.168.139.160:443/media_file/2016/09/07/85888A50D5386A29481E3399406DB63C..jpg?st=NXHHdYvQGctRsyo8_zK0qQ&e=1488807096",
		"isAutoDownload":0,
		"isAutoPreView":0,
		"uploader":"陈晨",
		"uploadTime":"2015-10-21 11:15:59",
		"callback":"OnDownloadCb"
	};
	NativeInteractive.download(parameter);
}
function OnDownloadCb(datas){
	var status = datas.result.status,
		params = datas.result.params;

	//这里做一个演示，把数据转成字符串在页面弹出
	var str_para = JSON.stringify(params);

	alert("download回调函数OnDownloadCb:"+str_para);
}
</script>


</body>
</html>

