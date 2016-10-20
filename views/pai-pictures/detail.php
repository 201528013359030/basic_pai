<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta id="viewport" name="viewport"
	content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<title>详细信息</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php use yii\helpers\Html;?>
<?=Html::cssFile('../views/css/jquery-confirm.css')?>
<?=Html::cssFile('../views/css/bootstrap.min.css')?>
<?=Html::cssFile('../views/css/easyzoom.css')?>
<!-- <link rel="stylesheet" -->
<!-- 	href="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
<script src="../views/js/jquery.js"></script>
<script src="../views/js/jquery-confirm.js"></script>
<script src="../views/js/bootstrap.min.js"></script>
<script src="../views/js/pinchzoom.js"></script>
<!-- <script -->
<!-- 	src="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
<style>
.carousel-inner>.item>img, .carousel-inner>.item>a>img {
	width: 100%;
	margin: auto;
}

.carousel, .carousel-inner {
	width: auto;
	height: 0px;
	padding-bottom: 100%
}

a, a:focus, a:hover, input:focus {
	-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
	text-decoration: none;
}

#delete {
	float: right;
	margin-right: 30px
}

#back {
	margin-left: 30px
}

.panel-body div {
	font-size: 16px;
	padding: 2px;
}

input, input:focus {
	border-left: medium none;
	border-right: medium none;
	border-top: medium none;
	border-bottom: 1px solid rgb(192, 192, 192);
}

.panel {
	width: 100%;
	margin-bottom: 0px
}

input:focus {
	outline: none;
}
/* button{ */
/* 	float:right; */
/* } */
/* input:focus {   */
/*     outline: none;   */
/*     border-color: #cfdc00;   */
/*     box-shadow: 0 0 5px rgba(207, 220, 0, 0.4);   */
/*     border-radius: 5px;   */
/* }  */
</style>
</head>
<body>
	<div>
		<br />
		<div id="myCarousel" class="carousel " data-ride="carousel slide"
			style='margin-top: 0px'>
			<!-- Indicators -->
			<!-- 			<ol class="carousel-indicators"> -->
			<!-- 				<li data-target="#myCarousel" data-slide-to=”0” class="active"></li> -->
			<!-- 				<li data-target="#myCarousel" data-slide-to=”1”></li> -->
			<!-- 				<li data-target="#myCarousel" data-slide-to=”2”></li> -->
			<!-- 				<li data-target="#myCarousel" data-slide-to=”3”></li> -->
			<!-- 			</ol> -->

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<!-- 			 				<div class="item active " id='Chania1'>  -->
				<!-- 							<a href='../views/image/0.jpg' >  -->
				<!-- 									<img src="../views/image/0.jpg" alt="Chania"> -->
				<!-- 				 				</a>  -->
				<!-- 							</div>  -->

				<!-- 							<div class="item " id='Chania2'>  -->
				<!-- 			 				<a href='../views/image/1.jpg'> -->
				<!-- 			 					<img src="../views/image/1.jpg" alt="Chania"> -->
				<!-- 				 				</a> -->
				<!-- 				 				</div>  -->

				<!-- 								<div class="item  " id='Flower1'> -->
				<!-- 								<a href='../views/image/2.jpg'> -->
				<!-- 			 					<img src="../views/image/2.jpg" alt="Flower1">  -->
				<!-- 								</a>  -->
				<!-- 							</div>  -->

				<!-- 				<div class="item" id='Flower2'> -->
				<!-- 					<a href='../views/image/3.jpg'> -->
				<!-- 					<img src="../views/image/3.jpg" alt="Flower2"> -->
				<!-- 					</a> -->
				<!-- 				</div> -->
			</div>

			<!-- Left and right controls -->
			<!-- data-slide="prev" data-slide="next" -->
			<a class="left carousel-control prev-slide" href="#myCarousel"
				role="button"> <span class="glyphicon glyphicon-chevron-left"
				aria-hidden="true"></span> <span class="sr-only">Previous</span>
			</a> <a class="right carousel-control next-slide" href="#myCarousel"
				role="button"> <span class="glyphicon glyphicon-chevron-right"
				aria-hidden="true"></span> <span class="sr-only">Next</span>
			</a>
		</div>
		<div class='panel panel-default'>
			<div class='panel-heading text-center'>图片信息</div>
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
							<button class='button btn-primary '>保存</button>
						</div>
					</div>
				</div>
				<div>
					上传时间:<span class='fCreateTime'>2015-06-08</span>
				</div>
			</div>
			<div class='panel-footer'>
				<a href='index.php?r=pai-pictures/index'><span
					class='glyphicon glyphicon-chevron-left' id='back'></span></a> <span
					class='glyphicon glyphicon-trash ' id='delete'></span>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(function(){
		var $jq = jQuery.noConflict();
		var detailList = new Array();
		var index=0;
		detailList.push(<?php echo json_encode($model)?>);
		
		$jq('.carousel').carousel({
			interval:false,
			});
			init();
			//var id;
			
			//初始化
			function init(){
				setView(detailList,'right');
			}

			//渲染页面
			function setView(list, flag){
				var view="";
				for(var i =0;i<list.length;i++){				
					if(list.length==1){
						view +='<div class="item active" id="'+list[i]['fID']+'">';
						}else{
							view +='<div class="item" id="'+list[i]['fID']+'">';
						}
				view+='<img src="'+list[0]['fPreviewPath']+'" alt="'+list[i]['fFileName']+'">';
				view+='</div>';
				}
				if(flag=='right'){
					$jq('.carousel-inner').append(view);
				}else if(flag=='left'){
					$jq('.carousel-inner').prepend(view);
				}
				if(detailList.length==1){
					$jq('.fOwner').text(detailList[0]['fOwner']);
					//if(detailList[0]['fDescription']!=''){
						$jq('.fDescription').val(detailList[0]['fDescription']);
					//}
					$jq('.fCreateTime').text(detailList[0]['fCreateTime']);			
					}
			}			

			//点击下一张图片
			$jq('.next-slide').click(function(){
				if(detailList.length-1==index){
	 				getRightData(detailList[index]['fID']);
	 			}else{
	 				$jq('#myCarousel').carousel(++index);
		 			}
	 			if(index>0){
	 				$jq('.left').show();					
		 			}
				});

			//点击上一张图片
			$jq('.prev-slide').click(function(){
				if(index<=0){
	 				getLeftData(detailList[0]['fID']);
	 			}else{
	 				//console.log(index);
	 				$jq('#myCarousel').carousel(--index);
	 				
		 			}
	 			if(index<detailList.length){
	 				$jq('.right').show();					
		 			}
				});

			//获取左面数据
			function getLeftData(id){
				var length=0;
				$jq.ajax({
					type:'GET',
					url:'index.php?r=pai-pictures/left',
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
							if(datas.length==0){
									//$jq.alert("没有数据了..");
									$jq('.left').hide();										
							}
							for(var i=0;i<datas.length;i++){
								detailList.unshift(datas[i]);
								}
							//console.log(detailList.length);
							setView(datas,'left');
							if(length>0){
								index=length-1;
								$jq('#myCarousel').carousel(index);
							}				
				   },
				 complete:function(){
							}
					});
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
						if(datas.length==0){
								$jq('.right').hide();					
						}
						for(var i=0;i<datas.length;i++){
							detailList.push(datas[i]);
							}
						setView(datas,'right');
						if(length>0){
							index=index+1;
							$jq('#myCarousel').carousel(index);
						}
						},
						complete:function(){
						}
				});

			}

			//放大缩小图片
            $jq('.carousel-inner').each(function () {
                new RTP.PinchZoom($jq(this), {
                            maxZoom:2,
                        });
            });

			//显示图片详细信息
			$jq('#myCarousel').on('slide.bs.carousel',function(){
				console.log(index);
				$jq('.fOwner').text(detailList[index]['fOwner']);
				$jq('.fDescription').val(detailList[index]['fDescription']);
				$jq('.fCreateTime').text(detailList[index]['fCreateTime']);			
				//alert('dd');
				//console.log(detailList);
// 				var carouselData = $jq(this).data('bs.carousel');
// 				console.log(carouselData);
// 				var items=carouselData.$items;
// 				//console.log(items);
// 				var currentIndex = carouselData.$jqactive;	
// //				console.log(carouselData);
// 				//console.log($jq(items).length);
// 				var length=$jq(items).length;
				//console.log($jq('.active').next().attr('id'));
		//		index=$jq('.active').index()-1;
				//console.log(index);
// 				console.log('index:'+index);
// 				console.log('length:'+detailList.length);
// 				console.log($jq('.active').attr('id'));
			//	id=$jq('.active').before.attr('id')
				//console.log('id:'+id);
// 				if(detailList.length-1==index){
// 					getRightData(detailList[detailList.length-1]['fID']);
// 					}
// 				if(index==0){
// 					getLeftData(detailList[0]['fID']);
// 					}
// 				index=index%detailList.length;
// 				//console.log(index);
				
//				if((length-1==index)){
// 					$jq.ajax({
// 						url:'index.php?r=test/getdata',
// 						type:'GET',
// 						data:{'id':'id'},
// 						error:function(){
// 							$jq.alert('error');
// 							},
// 							success:function(){
// 								alert('success');
// 								}
// 						});
//				}
// 				console.log(id);
				//console.log($jq(items:active));
// 					console.log($jq($jq(items)));
// 					console.log($jq(items).length);
// 				for(var i =0;i<$jq(items).length;i++){
// 					if($jq($jq(items)[i]).hasClass('active')){
// 							index=(i+1)%($jq(items).length);
// 							id=$jq($jq(items)[index]).attr('id');
// 							break;
// 								//console.log(i);
// 					}
						//id=$jq($jq(items)[i-1]).attr('id');
// 						if($jq(items)[i].hasClass('.active')){
// 								console.log(i);
// 							}
// 						console.log(i);
// 					}
// 				$jq('.username').text(id);
// 				$jq('.date').text(index);

// 				$jq('.button').click(function(){
// 						alert('save');
// 					});
				//console.log($jq(items[0]).find('item.active'));
				//var currentIndex = carouselData.getActiveIndex();
				
				//console.log(currentIndex);
				//alert(carouselData);
				//var currentIndex = carouselData.getActiveIndex();
				//alert(carouselData);
				});

			//保存图片描述信息
			$jq('.button').click(function(){
				var fDescription=$jq('.fDescription').val();
				//alert(fDescription);
			//	alert(detailList[index]['fID']);
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

			//删除图片
			$jq('#delete').click(function(){
				//alert('dd');
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
										$jq('.item').eq(index).remove();
										detailList.splice(index,1);
										if(index<detailList.length-1&&index>0){
											$jq('.item').eq(index).addClass('active');
										}else if(index==detailList.length&&index>0){
											$jq('.item').eq(--index).addClass('active');
										}else if(index==0 && detailList.length>0){
											$jq('.item').eq(index).addClass('active');
										}else if(index==0&&detailList.length==0){
											location.href = "index.php?r=pai-pictures/index";
										}
										$jq('.fOwner').text(detailList[index]['fOwner']);
										if(detailList[0]['fDescription']!=''){
											$jq('.fDescription').val(detailList[index]['fDescription']);
											}
										$jq('.fCreateTime').text(detailList[index]['fCreateTime']);		
									}
								},
								complete:function(){
								}
						});
				    },
				});
				});
	});
</script>
</body>
</html>
