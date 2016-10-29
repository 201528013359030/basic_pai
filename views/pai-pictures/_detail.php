<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<meta name="viewport"
	content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<title>详细信息</title>
    <?php use yii\helpers\Html;?>
    <?=Html::cssFile('../views/css/iSlider.css')?>
    <?=Html::cssFile('../views/css/bootstrap.min.css')?>
    <script src="../views/js/jquery.js"></script>
<script src="../views/js/bootstrap.min.js"></script>
    <?=Html::cssFile('../views/css/jquery-confirm.css')?>
    <style>
body {
	margin: 0;
	padding: 0;
	background: #333;
	overflow: hidden;
}

/*ul wrapper*/
#iSlider-wrapper {
	height: 100%;
	width: 100%;
	overflow: hidden;
	position: absolute;
}

#iSlider-wrapper ul {
	list-style: none;
	margin: 0;
	padding: 0;
	height: 100%;
	overflow: hidden;
}

#iSlider-wrapper li {
	position: absolute;
	margin: 0;
	padding: 0;
	height: 100%;
	overflow: hidden;
	display: -webkit-box;
	-webkit-box-pack: center;
	-webkit-box-align: center;
	list-style: none;
}

#iSlider-wrapper li img {
	max-width: 100%;
	max-height: 100%;
	/*
	max-height: 100%;
	*/
}

/*


     */
a, a:focus, a:hover, input:focus {
	-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
	text-decoration: none;
}

#delete {
	float: right;
	margin-right: 30px;
}

#back {
	margin-left: 30px;
	float: left;
	margin-bottom: 1px
}

.panel-body div {
	font-size: 16px;
	padding: 2px;
	margin-bottom: 1px
}

.panel-footer {
	margin-bottom: 0px;
}

input, input:focus {
	border-left: medium none;
	border-right: medium none;
	border-top: medium none;
	border-bottom: 1px solid rgb(192, 192, 192);
}

.panel {
	/*
	width: 100%;
	margin-bottom: 0px;
	*/
	width: 100%;
	background: #fff;
	border-bottom: 1px #f0f0f0 solid;
	border-top: 1px #f8f8f8 solid;
	position: fixed;
	bottom: 0;
	left: 0;
	margin-bottom: 0;
	z-index: 999;
	float: left;

	/*
	z-index: 999;
	*/
}

input:focus {
	outline: none;
}
</style>

</head>
<body>
	<div id="iSlider-wrapper"></div>

	<!-- panel begin -->
	<div class='panel panel-default'>
		<div class='panel-heading text-center'>图片信息</div>
		<!-- panel-body begin -->
		<div class='panel-body'>
			<div>
				上传者：<span class='fOwner'>test2013</span>
			</div>
			<div id='accordion'>
				描述： <a data-toggle='collapse' data-parent='#accordion'
					href='#collapse'>编辑</a>
			</div>
			<div id='collapse' class='panel-collapse collapse '>
				<div>
					<div class='col-xs-1 col-sm-1'>
						<span class='glyphicon glyphicon-pencil '></span>
					</div>
					<!-- 					<div class='col-xs-9'><textarea placeholder="请输入描述信息" class='message' rows='1'></textarea></div> -->
					<div class='col-xs-9 col-sm-9'>
						<input placeholder="请输入描述信息" class='fDescription' type='text' />
					</div>
					<div class='col-xs-2 col-sm-2'>
						<button class='button btn-primary ' id="save">保存</button>
					</div>
				</div>
			</div>
			<div>
				上传时间:<span class='fCreateTime'>2015-06-08</span>
			</div>
		</div>
		<!-- panel-body end -->
		<!-- panel-footer begin -->
		<div class='panel-footer' style='text-align: center'>
			<a href='index.php?r=pai-pictures/index'><span
				class='glyphicon glyphicon-chevron-left' id='back'></span></a> <span
				class='glyphicon glyphicon-trash ' id='delete'></span>
		</div>
		<!-- panel-footer end -->
	</div>
	<!-- panel end -->
	<script type="text/javascript" src="../views/js/iSlider.js"></script>
	<script type="text/javascript"
		src="../views/js/iSlider.plugin.zoompic.js"></script>
	<script src="../views/js/jquery-confirm.js"></script>
	<script id="show-code">
	var $jq = jQuery.noConflict();
	var detailList = new Array();
	var index=0;
	detailList.push(<?php echo json_encode($model)?>);
	var list=[];
	list.push({content:detailList[0]['fPreviewPath']});
	//list.push({content:'../views/img/0.jpg'});
// 	list = [
//         {content: "../views/img/0.jpg"},
//         {content: "../views/img/1.jpg"},
//         {content: "../views/img/2.jpg"},
//         {content: "../views/img/3.jpg"},
// //         {content: "//be-fe.github.io/static/images/iSlider-card/5.jpg"},
// //         {content: "//be-fe.github.io/static/images/iSlider-card/6.jpg"},
// //         {content: "//be-fe.github.io/static/images/iSlider-card/7.jpg"},
// //         {content: "//be-fe.github.io/static/images/iSlider-card/8.jpg"}
//     ];
	var clientStartX=0;
	var clientStartY=0;
	var clientEndX=0;
	var clientEndY=0;
	var index=0;
	var flag;
	//部分事件未用到，后期可以删除
    var S = new iSlider({
        dom: document.getElementById('iSlider-wrapper'),
        data: list,
        isLooping: 0,
        isOverspread: false,
        animateTime: 1000, // ms
        fillSeam:true,
        isDebug:0,
        plugins: [['zoompic', {zoomFactor: 3}]],
        oninitialize:initialize,
        oninitialized:initialized,
        onpluginInitialize:pluginInitialize,
        onpluginInitialized:pluginInitialized,
        onrendercomplete:rendercomplete,
        onslidestart:slideStart,
        onslide:slide,
        onslideend:slideEnd,
        onslidechange:slideChange,
        onslidechanged:slideChanged,
        onsliderestore:slideRestore,
        onsliderestored:slideRestored,
        loadData:loadData
    });
    function initialize(){
		console.log('initialize');
        }
    function initialized(){
		console.log('initialized');
        }
    function pluginInitialize(){
		console.log('pluginInitialize');
        }
    function pluginInitialized(){
		console.log('pluginInitialized');
        }
    function rendercomplete(){
		console.log('rendercomplete');
		$jq('.fOwner').text(detailList[this.slideIndex]['fOwner']);
		$jq('.fDescription').val(detailList[this.slideIndex]['fDescription']);
		$jq('.fCreateTime').text(detailList[this.slideIndex]['fCreateTime']);
		index=this.slideIndex;
        }
    function slideStart(e){
        console.log(this.slideIndex)
		console.log('=========slideStart');
		clientStartX=e.changedTouches[0]['clientX'];
		clientStartY=e.changedTouches[0]['clientY']
		console.log('+++++++++++slideStart');
        }
    function slide(e){
        }
    function slideEnd(e){
		console.log('======slideEnd');
		console.log(e);
		clientEndX=e.changedTouches[0]['clientX'];
		clientEndY=e.changedTouches[0]['clientY'];
		if(clientEndX-clientStartX==0&&clientEndY-clientStartY==0){
			if($jq('.panel').is(":hidden")){
				$jq('.panel').show();
			}else{
				$jq('.panel').hide();
				}
		}
		console.log('++++++slideEnd');
        }
    function loadData(){
		console.log('loadData');
        }
    function slideChange(){
		console.log('slideChange');
		index=this.slideIndex;
		setInformation(this.slideIndex);
       }
    function slideChanged(){
		console.log('slideChanged');
       }
    function slideRestore(){
		index=this.slideIndex;
        var direction;

		if(clientEndX-clientStartX>0){
			direction='left';
		}else{
		console.log('right');
		direction='right'
		}
	//console.log("length"+list.length);

	if(list.lenght==1){
		flag=true;
		if(direction=='left'){
			getLeftData(detailList[this.slideIndex]['fID']);
		}else if(direction=='right'){
			 getRightData(detailList[this.slideIndex]['fID']);
			}
	}else{
     if(direction=='right'&&this.slideIndex==list.length-1){
         flag=true;
		getRightData(detailList[this.slideIndex]['fID']);
    }else if(direction=='left'&&this.slideIndex==0){
        flag=true;
		getLeftData(detailList[this.slideIndex]['fID']);
    }
	}
   }
    function slideRestored(){
        if(flag)
     	this.loadData(list,index);
		//console.log('slideRestored');
		//console.log(this);
		//console.log(this.slideIndex);
		//this.reset();
		//this.slideTo(index);
        }
    function getData(){
        console.log('oninitialized');
		//getRightData(detailList[this.slideIndex]['fID']);
      }
    function restore(){
        console.log('restore');
       // console.log("restore");
//        console.log(this.slideIndex);
//        if(this.slideIndex==list.length-1){
//            //console.log(detailList);
//     	   getRightData(detailList[this.slideIndex]['fID']);
//     	  // console.log(list);
// 			//console.log("加载数据");
//           }else if(this.slideIndex==0){
// 				getLeftData(detailList[this.slideIndex]['fID']);

//               }
    }

function Slide(e){
	console.log(e);
}
function onSlide(e){
	console.log('onSlide');
	console.log(e);
	console.log(this);
	console.log(this.slideIndex);
}
// function slideEnd(){
// 	console.log('endSlide');
// 	console.log(list);
// 	console.log(this.slideIndex);
// 	console.log(list[this.slideIndex]);
// }
// 	S.on('onslide',function(){
// 			console.log("mmm");
// 			console.log(this.slideIndex);
// 		});

// 	S.on('initialize',function(){
// 		console.log('initialize');
// 		});

//console.log($jq('img'));

    ////
//         $jq('.text ').click(function(){
// // 				console.log('dd');

// // 				console.log($jq('.panel').is(":hidden"));
// 				if($jq('.panel-heading').is(":hidden")&&$jq('.panel-body').is(":hidden")){
// 					$jq('.text').text('点击隐藏详细信息');
// 						$jq('.panel-heading').show();
// 						$jq('.panel-body').show();
// 					}else{
// 						//$jq('.panel').hide();
// 						$jq('.text').text('点击显示详细信息');
// 						$jq('.panel-heading').hide();
// 						$jq('.panel-body').hide();
// 					}
//         });


// $jq('#iSlider-wrapper').click(function(){
// 	alert('ddd');
// });


		//获取左面数据
		function getLeftData(id){
	//		var length=0;
			//var flag="";
			//var leftData=[];
			$jq.ajax({
				type:'GET',
				url:'index.php?r=pai-pictures/left',
				data:{'id':id},
				dataType:'json',
				error:function(){
					//$jq.alert('error');
					flag="error";
					$jq.alert({
						title:'提示信息',
						content:"出错了.....",
						confirmButton:'确认'
						});
					},
			   success:function(datas){
				 	//  flag='success';
						length=datas.length;
						console.log(datas);
						datas.reverse();
						for(var i=datas.length-1;i>=0;i--){
							detailList.unshift(datas[i]);
							list.unshift({content:datas[i]['fPreviewPath']});
							}
						if(length>0){
							index=datas.length-1;
						}
						//console.log(list);
			   },
			 complete:function(){
					}
				});
		//	return leftData;
			}

//获取右面数据
	function getRightData(id){
		var length=0;
		$jq.ajax({
			type:'GET',
			url:'index.php?r=pai-pictures/right',
			data:{'id':id},
			dataType:'json',
			error:function(){
				//$jq.alert('error');
				$jq.alert({
					title:'提示信息',
					content:"出错了.....",
					confirmButton:'确认'
					});
				},
			success:function(datas){
				length=datas.length;
// 					console.log(datas);
// 					console.log(id);
					for(var i=0;i<datas.length;i++){
						detailList.push(datas[i]);
						console.log("datas begin");
						console.log(datas[i]['fPreviewPath'])
						list.push({content:datas[i]['fPreviewPath']});

						}
					console.log(list);
					if(length>0){
						index+=1;
						}
					},
					complete:function(){
						console.log('complete');
					}
			});

		}
	//显示图片详细信息
	function setInformation(_index){
		$jq('.fOwner').text(detailList[_index]['fOwner']);
		$jq('.fDescription').val(detailList[_index]['fDescription']);
		$jq('.fCreateTime').text(detailList[_index]['fCreateTime']);
		}

	//保存图片描述信息
	$jq('.button').click(function(){
		var fDescription=$jq('.fDescription').val();
		$jq.ajax({
				url:'index.php?r=pai-pictures/update',
				type:'GET',
				data:{'fDescription':fDescription,'id':detailList[index]['fID']},
				error:function(){
						//$jq.alert('Error');
					$jq.alert({
						title:'提示信息',
						content:"出错了.....",
						confirmButton:'确认'
						});
					},
					success:function(data){
						if(data=='success'){
							detailList[index]['fDescription']=fDescription;
								$jq.alert({
									title:'提示信息',
									content:"保存成功",
									confirmButton:'确认'
									});
							}
						}
			});
		});


	//删除图片信息
	$jq('#delete').click(function(){
		var id=detailList[index]['fID'];
		$jq.confirm({
		    title: '删除提示',
		    content: '确认删除该图片吗？',
		    confirmButton:'确认',
		    cancelButton:'取消',
		    confirm: function(){
				$jq.ajax({
					url:'index.php?r=pai-pictures/delete',
					type:'GET',
					data:{'id':detailList[index]['fID']},
					error:function(){
						//alert('error');
						//	$jq.alert('删除失败');
							$jq.alert({
								title:'提示信息',
								content:"删除失败",
								confirmButton:'确认'
								});
						},
						success:function(data){
							if(data=='error'){
								//$jq.alert('删除失败');
								$jq.alert({
									title:'提示信息',
									content:"删除失败",
									confirmButton:'确认'
									});
							}else{
								//$jq('.item').eq(index).remove();
								console.log('index'+index);
								S.loadData(list,index);
								detailList.splice(index,1);
								list.splice(index,1);
								//删除图片（不是第一张也不是最后一张），自动跳转到下一张
								if(index<detailList.length-1&&index>0){
									S.loadData(list,index);
									//删除图片（不是第一张但是是最后一张），自动跳转到上一张
								}else if(index==detailList.length&&index>0){
									--index;
									S.loadData(list,index);
									//删除图片（是第一张但不是最后一张），自动跳转到下一张
								}else if(index==0 && detailList.length>0){
									S.loadData(list,index);
									//删除图片（是第一张也是最后一张），自动跳转到首页
								}else if(index==0&&detailList.length==0){
									location.href = "index.php?r=pai-pictures/index";
								}
							}
						},
						complete:function(){
						}
				});
		    },
	});
		});
</script>
</body>
</html>