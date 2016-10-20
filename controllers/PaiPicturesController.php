<?php

namespace app\controllers;

use Yii;
use app\models\PaiPictures;
use app\models\PaiPicturesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\WebService;
use app\models\PaiUser;
use app\models\UtilsModel;

/**
 * PaiPicturesController implements the CRUD actions for PaiPictures model.
 */
class PaiPicturesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

//     /**
//      * Lists all PaiPictures models.
//      * @return mixed
//      */
//     public function actionIndex()
//     {
//     	$request=Yii::$app->request;

//         $searchModel = new PaiPicturesSearch();
//         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//         $webpara=new app\models\WebServiceParam;

//         $webpara->setUid($uid);

//         return $this->render('index', [
//             'searchModel' => $searchModel,
//             'dataProvider' => $dataProvider,
//         ]);
//     }

    /**
     * Lists all PaiPictures models.
     *
     * uid：用户的唯一标识，
     * eguid：用户企业的唯一标识，
     * auth_token：用户的认证token，轻应用需要用该token与之前的uid调用ICT中的接口进行用户认证
     * gid：用户通过群组进入轻应用，例如公告轻应用通过该参数可以直接给该群组发送公告
     * nid：用户通过组织架构中节点进入轻应用
     *
     * @return mixed
     */
    public function actionIndex()
    {
    	//获取请求url参数

    	$request=Yii::$app->request;
    	$session=Yii::$app->session;

    	$uid=$request->get('uid')||die('获取uid失败');
    	$eguid=$request->get('eguid')||die('获取eguid失败');
    	$auth_token=$request->get('auth_token')||die('获取auth_token失败');
    	$gid=$request->get('gid')||die('获取gid失败');
    	$nid=$request->get('nid')||die('获取nid失败');
    	$eid=explode('@', $uid)[1];
    	$api_key='36116967d1ab95321b89df8223929b14207b72b1';
    	$webServiceUrl = "http://192.168.139.160/elgg/services/api/rest/json/";

    	//webserviceparam 参数设置
    	$webService=new WebService();
    	$webService->setUid($uid);
    	$webService->setEguid($eguid);
    	$webService->setAuth_token($auth_token);
    	$webService->setEid($eid);
    	$webService->setApi_key($api_key);
    	$webService->setWebService($webServiceUrl);

    	//验证认证信息有效性
    	$webService->checkAuth_Token();

    	if (! isset ( $result->status )) {
    		return 'auth_token不存在，认证返回失败!';
    	}
    	if ('0' != $result->status) {

    		return '认证返回失败!';
    	}
    	if ('1' != $result->result->success) {
    		return '认证失败!';
    	}


//     	$searchModel = new PaiPicturesSearch();
//     	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//     	$model=new PaiPictures();

    	//获取用户信息
    	$uid=$webService->getUid();
    	$user= PaiUser::findone($uid);

    	if(!$user){
    		//游客
    	return 	$this->renderFile('@app/views/pai-pictures/welcome.php');

    	}
    	$session->set('admin',$user->admin);

    	if($user->admin==0){

    		//普通用户身份
    		$model= PaiPictures::find()->where([
    				'fowner'=>$uid,
    		])->limit(3)->orderBy([
    				'fCreateTime'=>SORT_DESC,
    		])->asArray()->all();

    	return	$this->renderFile('@app/views/pai-pictures/user.php',[
    				'model'=>$model,
    		]);

    	}elseif($user->admin==1){

    		//管理员身份
    		$model= PaiPictures::find()->orderBy([
    				'fCreateTime'=>SORT_DESC,
    		])->asArray()->all();

    	return  $this->renderFile('@app/views/pai-pictures/admin.php',[
    				'model'=>$model,
    		]);

    	}


//     	return $this->render('index', [
//     			'searchModel' => $searchModel,
//     			'dataProvider' => $dataProvider,
//     	]);
    }

    /**
     * Displays a single PaiPictures model.
     * @param string $id
     * @return mixed
     */
    public function actionDetail($id)
    {
//     	$sql='select * from pai_pictures where

    	return $this->render('detail', [
    			'model' => $this->findModel($id)->toArray(),
    	]);
    }

    /**
     * Displays a single PaiPictures model as slid to the right .
     * @param string $id
     * @return mixed
     */
    public function actionRight($id){
    	$admin=$session->get('admin');
    	if($admin==0){
    		//向右查看
    		$modelRight=PaiPictures::find()->where([
    				'fOwner'=>WebService::getUid(),
    		])->andwhere([
    				'<',
    				'fCreateTime',
    				PaiPictures::findOne($id)->toArray()['fCreateTime']
    		])->orderBy([
    				'fCreateTime'=>SORT_DESC
    		])->limit(6)->asArray->all;
    	}
    	elseif ($admin==1){

    		//向右查看
    		$modelRight=PaiPictures::find()->where([
    				'<',
    				'fCreateTime',
    				PaiPictures::findOne($id)->toArray()['fCreateTime']
    		])->orderBy([
    				'fCreateTime'=>SORT_DESC
    		])->limit(6)->asArray->all;
    	}
    	echo json_encode ( [
    			'modelRight' => $modelRight
    	] );
    }

    /**
     * Displays a single PaiPictures model as slid to the left.
     * @param string $id
     * @return mixed
     */
    public function actionLeft($id){
    	$admin=$session->get('admin');
    	if($admin==0){

    		//向左查看
    		$modelLeft=PaiPictures::find()->where([
    				'fOwner'=>WebService::getUid(),
    		])->andwhere([
    				'>',
    				'fCreateTime',
    				PaiPictures::findOne($id)->toArray()['fCreateTime']
    		])->orderBy([
    				'fCreateTime'=>SORT_ASC
    		])->limit(6)->asArray->all;

    	}
    	elseif ($admin==1){

    		//向左查看
    		$modelLeft=PaiPictures::find()->where([
    				'>=',
    				'fCreateTime',
    				PaiPictures::findOne($id)->toArray()['fCreateTime']
    		])->orderBy([
    				'fCreateTime'=>SORT_ASC
    		])->limit(6)->asArray->all;
    	}
    	echo json_encode ( [
    			'modelLeft' => $modelLeft
    	] );
    }

    /**
     * Displays a single PaiPictures model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

//     /**
//      * Creates a new PaiPictures model.
//      * If creation is successful, the browser will be redirected to the 'view' page.
//      * @return mixed
//      */
//     public function actionCreate()
//     {

//     	$model = new PaiPictures();
//     	$utils=new UtilsModel();

//         $model->fID= $utils->saveGetmaxNum ( 'QJDH', 11 );

//         if ($model->load(Yii::$app->request->post()) && $model->save()) {

//             return $this->redirect(['view', 'id' => $model->fID]);
//         } else {
//             return $this->render('create', [
//                 'model' => $model,
//             ]);
//         }
//     }


    public  function actionUploadpic(){

	    return $this->renderFile('@app/views/pai-pictures/uploadpic.php');
    }

    /**
     * Creates a new PaiPictures model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

    	$model = new PaiPictures();
    	$utils=new UtilsModel();

    	$model->fID= $utils->saveGetmaxNum ( 'QJDH', 11 );
    	$model->fFileName='';
    	$model->fPreviewPath='';
    	$model->fDownloadPath='';
    	$model->fOwner='';
    	$model->fUserName='';
    	$model->fCreateTime='';
    	$model->fDescription='3@15';
    	$model->fTaskID='';
    	$model->fThumb='';

    	print_r($model);
    	return;

    	if ($model->load(Yii::$app->request->post()) && $model->save()) {

    		return $this->redirect(['view', 'id' => $model->fID]);
    	} else {
    		return $this->render('create', [
    				'model' => $model,
    		]);
    	}
    }

    /**
     * Updates an existing PaiPictures model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

    	$model=PaiPictures::findOne($id);

    	if ($model->load(Yii::$app->request->get()) && $model->save()) {

    		echo json_encode ( [
    				'result' => 'success'
    		] );

    		//             return $this->redirect(['view', 'id' => $model->fID]);
    	} else {

    		echo json_encode ( [
    				'result' => 'error'
    		] );

    		//             return $this->render('update', [
    		//                 'model' => $model,
    		//             ]);
    	}
    }

    /**
     * Deletes an existing PaiPictures model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	if( $this->findModel($id)->delete())
    	{

    		echo json_encode ( [
    				'result' => 'success'
    		] );
    	}else{
    		echo json_encode ( [
    				'result' => 'error'
    		] );
    	}

    	//         return $this->redirect(['index']);
    }

//     /**
//      * Updates an existing PaiPictures model.
//      * If update is successful, the browser will be redirected to the 'view' page.
//      * @param string $id
//      * @return mixed
//      */
//     public function actionUpdate($id)
//     {
//         $model = $this->findModel($id);

//         if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->fID]);
//         } else {
//             return $this->render('update', [
//                 'model' => $model,
//             ]);
//         }
//     }

//     /**
//      * Deletes an existing PaiPictures model.
//      * If deletion is successful, the browser will be redirected to the 'index' page.
//      * @param string $id
//      * @return mixed
//      */
//     public function actionDelete($id)
//     {
//         $this->findModel($id)->delete();

//         return $this->redirect(['index']);
//     }

    /**
     * Finds the PaiPictures model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PaiPictures the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PaiPictures::findOne($id)) !== null) {

        	return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
