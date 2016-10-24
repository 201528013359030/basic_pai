<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--
    User: Cupid
    Date: 2016/10/21
    Time: 15:39
-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"  />

    <title>会议记录</title>
    <link rel="stylesheet" type="text/css" href="css/commes.css" />
    <link rel="stylesheet" type="text/css" href="css/listcommon.css" />
    <link rel="stylesheet" type="text/css" href="css/module.css" />
    <link rel="stylesheet" type="text/css" href="css/public.css" />
    <link rel="stylesheet" href="css/photoswipe.css"/>
    <link rel="stylesheet" href="css/default-skin/default-skin.css"/>


</head>
<body>
<div class="container">
    <!--用户头像 预留位置-->
    <!--
    <div class="header">
       <div><img src="images/1.jpg" /></div>
    </div>
    -->
    <?php foreach ($model as $mod){?>
        <?=Html::beginTag('a',['class'=>'listcontain','uid'=>$uid,'href'=>'images/1.jpg'.$uid])?>
            <div class="listcontain">
                 <div class="demo">
                    <!--用户名and发布时间-->
                    <div class="use">
                         <div class="usename"><span><?=Html::encode($mod['']) ?></span><em class="pub-time"><?=Html::encode($mod['']) ?></em></div>
                    </div>
                    <!--分享的内容-->
                    <p class="fx_content"><?=Html::encode($mod['']) ?></p>
                     <!--分享的图片-->
                     <div class="my-gallery">
                     <!--   <img src="images/2.jpg" /> -->
                         <?= Html::tag('img',['href'=>$mod['']]) ?>
                     </div>
                 </div>
            </div>
        <?=Html::endTag('a')?>
    <?php }?>
    <div class="row">
        <div class="small-12 columns">
            <?= Html::tag('a', Html::encode("上传图片"), ['href'=>'index.php?r=leavebill/more&uid='.$uid,'class'=>'button expand','uid'=>$uid]) ?>
            <!-- 上传图片 -->
        </div>
    </div>
</div>
</body>
</html>