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
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use app\models\UtilsModel;
use app\models\CurlModel;

/**
 * PaiPicturesController implements the CRUD actions for PaiPictures model.
 */
class PaiPicturesController extends Controller {
	public $enableCsrfValidation = false;
	
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [ 
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'delete' => [ 
										'GET' 
								] 
						] 
				] 
		];
	}
	public function actionTest1() {
		return $this->renderFile ( '@app/views/pai-pictures/_detail.php' );
	}
	// /**
	// * Lists all PaiPictures models.
	// * @return mixed
	// */
	// public function actionIndex()
	// {
	// $request=Yii::$app->request;
	
	// $searchModel = new PaiPicturesSearch();
	// $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	
	// $webpara=new app\models\WebServiceParam;
	
	// $webpara->setUid($uid);
	
	// return $this->render('index', [
	// 'searchModel' => $searchModel,
	// 'dataProvider' => $dataProvider,
	// ]);
	// }
	public function actionTest() {
		// $web =new WebService();
		// $result = $web->getApps();
		// print_r($result);
		return $this->renderFile ( '@app/views/pai-pictures/refresh.php' );
	}
	
	/**
	 * auth.gettoken 获取用户认证信息
	 *
	 * @param
	 *        	array
	 * @return mixed
	 * @author fyq
	 */
	public static function actionGetToken($params) {
		
		// auth_token认证
		$params = [ 
				'name' => $params ['name'],
				'password' => $params ['password'],
				'api_key' => $params ['api_key'] 
		];
		$webService = 'http://192.168.139.160/elgg/services/api/rest/json/?method=auth.gettoken';
		$curl = new CurlModel ();
		$result = $curl->post ( $webService, $params );
		
		$result = json_decode ( $result );
		return $result;
	}
	
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
	public function actionIndex() {
		
		// 获取请求url参数
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		
		if (! $session->isActive) {
			$session->open ();
		}
		
		/**
		 * ************************ 临时获取token测试用 begin**********************************
		 */
		
		if (! ($request->get ( 'uid' ) && $request->get ( 'auth_token' ) && $request->get ( 'eguid' ))) {
			$params = [ 
					'name' => '18900913303',
					'password' => '123456',
					'api_key' => '36116967d1ab95321b89df8223929b14207b72b1' 
			];
			$result = $this->actionGetToken ( $params );
			
			$uid = $result->result->uid;
			$auth_token = $result->result->auth_token;
			$eguid = $result->result->eguid;
		
		/**
		 * ************************ 临时获取token测试用 end**********************************
		 */
		} else {
			$uid = $request->get ( 'uid' );
			$eguid = $request->get ( 'eguid' );
			$auth_token = $request->get ( 'auth_token' );
		}
		
		$lappid = $request->get ( 'lappid', '48' );
		$eid = explode ( '@', $uid ) [1];
		
		$session ['userId'] = $uid;
		$session ['auth_token'] = $auth_token;
		$session ['eguid'] = $eguid;
		$session ['eid'] = $eid;
		$session ['lappid'] = $lappid;
		
		$webService = new WebService ();
		
		// 验证认证信息有效性
		$result = $webService->checkAuth_Token ();
		
		if (! isset ( $result->status )) {
			return 'auth_token不存在，认证返回失败!';
		}
		if ('0' != $result->status) {
			
			return '认证返回失败!';
		}
		if ('1' != $result->result->success) {
			return '认证失败!';
		}
		
		// 获取用户信息
		
		$uid = $webService->getUid ();
		$user = PaiUser::findone ( $uid );
		
		if (! $user) {
			// 游客
			return $this->renderFile ( '@app/views/pai-pictures/welcome.php' );
		}
		
		$session ['userName'] = $user->user_name;
		$session ['admin'] = $user->admin;
		$session ['pageSize'] = 4;
		date_default_timezone_set ( 'PRC' );
		$pageSize = $session ['pageSize'];
		// curTime = date ( 'Y-m-d H:i:s' );
		
		if ($user->admin == 0) {
			
			// 普通用户身份
			// $searchModel = new LeavebillSearch ();
			$total = PaiPictures::find ()->where ( [ 
					'fOwner' => $uid 
			] )->count ();
			$totalPage = ceil ( $total / $pageSize );
			
			$data = PaiPictures::find ()->where ( [ 
					'fOwner' => $uid 
			] )->orderBy ( [ 
					'fCreateTime' => SORT_DESC 
			] )->offset ( 0 )->limit ( $pageSize )->asArray ()->all ();
			
			// $model = PaiPictures::find ()->where ( [
			// 'fowner' => $uid
			// ] )->limit ( 3 )->orderBy ( [
			// 'fCreateTime' => SORT_DESC
			// ] )->asArray ()->all ();
		} elseif ($user->admin == 1) {
			
			// 管理员身份
			// $searchModel = new LeavebillSearch ();
			$total = PaiPictures::find ()->orderBy ( [ 
					'fCreateTime' => SORT_DESC 
			] )->count ();
			$totalPage = ceil ( $total / $pageSize );
			
			$data = PaiPictures::find ()->orderBy ( [ 
					'fCreateTime' => SORT_DESC 
			] )->offset ( 0 )->limit ( $pageSize )->asArray ()->all ();
		}
		
		// 管理员身份
		// $model = PaiPictures::find ()->orderBy ( [
		// 'fCreateTime' => SORT_DESC
		// ] )->asArray ()->all ();
		// }
		
		return $this->renderFile ( '@app/views/pai-pictures/piclist.php', [
				// 'model' => $model,
				'pageSize' => $pageSize,
				'total' => $total,
				'totalPage' => $totalPage,
				// 'data' => $data,
				'data' => json_encode ( $data ) 
		] );
	}
	
	/**
	 *
	 * @abstract loadmore PaiPictures data
	 *          
	 * @author fyq
	 * @return json data
	 */
	public function actionLoadmore() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;
		$uid = $session ['userId'];
		$page = $request->get ( 'page', '0' );
		$pageSize = $session ['pageSize'];
		date_default_timezone_set ( 'PRC' );
		// $curTime = date ( 'Y-m-d H:i:s' );
		
		if ($session ['admin'] == 0) {
			
			// 普通用户身份
			
			$data = PaiPictures::find ()->where ( [ 
					'fOwner' => $uid 
			] )->orderBy ( [ 
					'fCreateTime' => SORT_DESC 
			] )->offset ( $page * $pageSize )->limit ( $pageSize )->asArray ()->all ();
			
			// $model = PaiPictures::find ()->where ( [
			// 'fowner' => $uid
			// ] )->limit ( 3 )->orderBy ( [
			// 'fCreateTime' => SORT_DESC
			// ] )->asArray ()->all ();
		} elseif ($session ['admin'] == 1) {
			
			// 管理员身份
			$total = PaiPictures::find ()->orderBy ( [ 
					'fCreateTime' => SORT_DESC 
			] )->count ();
			$totalPage = ceil ( $total / $pageSize );
			
			$data = PaiPictures::find ()->orderBy ( [ 
					'fCreateTime' => SORT_DESC 
			] )->offset ( $page * $pageSize )->limit ( $pageSize )->asArray ()->all ();
		}
		
		echo json_encode ( [ 
				'data' => $data 
		] );
	}
	
	/**
	 * Displays a single PaiPictures model.
	 *
	 * @param string $id        	
	 * @return mixed
	 */
	public function actionDetail($id) {
		return $this->renderFile ( '@app/views/pai-pictures/_detail.php', [ 
				'model' => $this->findModel ( $id ) 
		] );
	}
	
	/**
	 * Displays a single PaiPictures model as slid to the right .
	 *
	 *
	 *
	 *
	 *
	 *
	 *
	 *
	 *
	 * @param string $id        	
	 * @return mixed
	 */
	public function actionRight() {
		$session = Yii::$app->session;
		$request = Yii::$app->request;
		$admin = $session->get ( 'admin', '0' );
		// $admin='1';
		$id = $request->get ( 'id', '0' );
		if ($admin == 0) {
			// 向右查看
			$modelRight = PaiPictures::find ()->where ( [ 
					'fOwner' => $session ['userId'] 
			] )->andwhere ( [ 
					'<',
					'fCreateTime',
					PaiPictures::findOne ( $id ) ['fCreateTime'] 
			] )->orderBy ( [ 
					'fCreateTime' => SORT_DESC 
			] )->limit ( 6 )->asArray ()->all ();
		} elseif ($admin == 1) {
			
			// 向右查看
			$modelRight = PaiPictures::find ()->where ( [ 
					'<',
					'fCreateTime',
					PaiPictures::findOne ( $id ) ['fCreateTime'] 
			] )->orderBy ( [ 
					'fCreateTime' => SORT_DESC 
			] )->limit ( 6 )->asArray ()->all ();
		}
		
		// ajax 调用的返回格式
		echo json_encode ( $modelRight );
	}
	
	/**
	 * Displays a single PaiPictures model as slid to the left.
	 *
	 * @param string $id        	
	 * @return mixed
	 */
	public function actionLeft() {
		$session = Yii::$app->session;
		$request = Yii::$app->request;
		$admin = $session->get ( 'admin' );
		// $admin = '1';
		$id = $request->get ( 'id', '0' );
		if ($admin == 0) {
			
			// 向左查看
			$modelLeft = PaiPictures::find ()->where ( [ 
					'fOwner' => $session ['userId'] 
			] )->andwhere ( [ 
					'>',
					'fCreateTime',
					PaiPictures::findOne ( $id ) ['fCreateTime'] 
			] )->orderBy ( [ 
					'fCreateTime' => SORT_ASC 
			] )->limit ( 6 )->asArray ()->all ();
		} elseif ($admin == 1) {
			
			// 向左查看
			$modelLeft = PaiPictures::find ()->where ( [ 
					'>',
					'fCreateTime',
					PaiPictures::findOne ( $id ) ['fCreateTime'] 
			] )->orderBy ( [ 
					'fCreateTime' => SORT_ASC 
			] )->limit ( 6 )->asArray ()->all ();
		}
		
		// ajax 调用的返回格式
		echo json_encode ( $modelLeft );
	}
	
	/**
	 * Displays a single PaiPictures model.
	 *
	 * @param string $id        	
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render ( 'view', [ 
				'model' => $this->findModel ( $id ) 
		] );
	}
	public function actionUploadtest() {
		return $this->renderFile ( '@app/views/pai-pictures/upload.php' );
	}
	
	/**
	 * Updates an existing PaiPictures model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param string $id        	
	 * @return mixed
	 */
	public function actionUpload() {
		$data = Yii::$app->request->post ( 'params' );
		$session = Yii::$app->session;
		$model = new PaiPictures ();
		$utils = new UtilsModel ();
		
		// 拼接缩略图地址(android终端不返回缩略图地址，要在原图地址上拼接出缩略图地址，将原图地址最后的'..'换成'small.'即可)
		$arr = explode ( '..', $data ['uploadPath'] );
		if (count ( $arr ) > 1) {
			// 缩略图jpg
			$fThumb = $arr [0] . 'small.jpg?' . explode ( '?', $arr [1] ) [1];
		} else {
			$fThumb = $data ['thumb'];
		}
		
		$model->fID = $utils->saveGetmaxNum ( 'QJDH', 11 );
		$model->fFileName = $data ['fileName'];
		$model->fPreviewPath = $data ['uploadPath'];
		$model->fDownloadPath = $data ['uploadPath'];
		$model->fOwner = Yii::$app->session->get ( 'userId' );
		$model->fUserName = Yii::$app->session->get ( 'userName', '' );
		$model->fCreateTime = date ( 'Y-m-d H:i:s' );
		$model->fDescription = '';
		$model->fTaskID = $data ['taskID'];
		$model->fThumb = $fThumb;
		
		$web = new WebService ();
		
		if ($model->save ()) {
			$success = '';
			$to_uids = '';
			$userdata = PaiUser::find ()->where ( [ 
					'admin' => '1' 
			] )->andWhere ( [ 
					'not in',
					'user_id',
					Yii::$app->session->get ( 'userId' ) 
			] )->asArray ()->all ();
			
			foreach ( $userdata as $key => $arr ) {
				$to_uids [$key] = $arr ['user_id'];
			}
			
			$url = 'http://' . $_SERVER ['HTTP_HOST'] . '/basic_pai/web/index.php?r=pai-pictures/index&uid=&eguid=&auth_token=';
			$title = $session ['userName'] . '上传了图片!';
			
			$result = $web->sendNotice ( $to_uids, $title, $url );
			
			if (! isset ( $result->status )) {
				$success = 'service 调用失败!';
				echo json_encode ( [ 
						'success' => $success 
				] );
				exit ();
			}
			if ('0' != $result->status) {
				
				$success = '发通知返回失败!';
				echo json_encode ( [ 
						'success' => $success 
				] );
				exit ();
			}
			if ('1' != $result->result->success) {
				$success = '发通知操作失败!';
				echo json_encode ( [ 
						'success' => $success 
				] );
				exit ();
			}
			
			$success = '成功!';
			echo json_encode ( [ 
					'success' => $success 
			] );
			exit ();
		} else {
			echo json_encode ( [ 
					'success' => 'save fail',
					'model' => $model->fFileName 
			] );
			exit ();
		}
		
		// print_r($model);
		// return;
		
		// if ($model->load(Yii::$app->request->post()) && $model->save()) {
		
		// return $this->redirect(['view', 'id' => $model->fID]);
		// } else {
		// return $this->render('create', [
		// 'model' => $model,
		// ]);
		// }
	}
	
	/**
	 * Updates an existing PaiPictures model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param string $id        	
	 * @return mixed
	 */
	public function actionUpdate() {
		$id = Yii::$app->request->get ( 'id', '0' );
		$fDescription = Yii::$app->request->get ( 'fDescription' );
		$model = PaiPictures::findOne ( $id );
		$model ['fDescription'] = $fDescription;
		if ($model->save ()) {
			echo 'success';
		} else {
			echo 'error';
		}
	}
	
	/**
	 * Deletes an existing PaiPictures model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param string $id        	
	 * @return mixed
	 */
	public function actionDelete() {
		$id = Yii::$app->request->get ( 'id' ) || die ( '没有得到要删除的ID' );
		$id = Yii::$app->request->get ( 'id' );
		if (PaiPictures::findOne ( $id )->delete ()) {
			echo 'success';
		} else {
			echo 'error';
		}
		// return $this->redirect(['index']);
	}
	
	/**
	 * Finds the PaiPictures model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param string $id        	
	 * @return PaiPictures the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = PaiPictures::findOne ( $id )->toArray ()) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
