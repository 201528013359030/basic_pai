<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * weservice接口的一些公共参数
 *
 * @author fang
 *
 *@
 *
 * @property static string $uid 用户的全局ID
 * @property static string $auth_token 认证字符串
 * @property static string $api_key 客户端接口认证公钥
 * @property static string $eid 用户所在公司的id，企业id可在uid中解析到，@ 符后面数字为eid
 * @property static string $lappid 轻应用的唯一ID (lappid)
 * @property static string $eguid 企业的全局唯一ID ？？？干什么用的 ？？？
 * @property static string $webServiceUrl webservice url
 * @property static string $gid 用户通过群组进入轻应用，例如公告轻应用通过该参数可以直接给该群组发送公告
 * @property static string $nid 用户通过组织架构中节点进入轻应用
 *
 */
class WebService extends Model{

	private static $uid;
	private static $auth_token;
	private static $api_key;
	private static $eid;
	private static $lappid;
	private static $eguid;
	private static $webServiceUrl;
	private static $gid;
	private static $nid;

	function __construct(){

		$session = Yii::$app->session;
		static ::$api_key='36116967d1ab95321b89df8223929b14207b72b1';
		static ::$webServiceUrl='http://192.168.139.160/elgg/services/api/rest/json/';

		//webserviceparam 参数设置
		$this->setUid($session['userId']);
		$this->setEguid($session['eguid']);
		$this->setAuth_token($session['auth_token']);
		$this->setEid($session['eid']);
		$this->setlappid($session['lappid']);

	}


	public static function setUid($uid){
		static ::$uid=$uid;
	}

	public static function getUid(){
		return static ::$uid;
	}

	public static function setAuth_token($auth_token){
		static ::$auth_token=$auth_token;
	}
	public static function getAuth_token(){
		return static ::$auth_token;
	}

	public static function setApi_key($api_key){
		static ::$api_key=$api_key;
	}
	public static function getApi_key(){
		return static ::$api_key;
	}

	public static function setEid($eid){
		static ::$eid=$eid;
	}
	public static function getEid(){
		return static ::$eid;
	}

	public static function setlappid($id){
		static ::$lappid=$id;
	}
	public static function getLappid(){
		return static ::$lappid;
	}

	public function setEguid($eguid){
		static ::$eguid=$eguid;
	}
	public static function getEguid(){
		return static ::$eguid;
	}

	public static function setWebServiceUrl($webServiceUrl){
		static ::$webServiceUrl=$webServiceUrl;
	}
	public static function getWebServiceUrl(){
		return static ::$webServiceUrl;
	}

	public static function setGid($gid){
		static ::$gid=$gid;
	}
	public static function getGid(){
		return static ::$gid;
	}

	public static function setNid($nid){
		static ::$nid=$nid;
	}
	public static function getNid(){
		return static ::$nid;
	}

	/**
	 * check.user.token auth_token验证
	 *
	 * @return mixed
	 * @author fyq
	 */
	public static function checkAuth_Token() {

		$params = [
				'uid' => static ::$uid,
				'auth_token' => static ::$auth_token,
				'api_key' =>static ::$api_key
		];
		$webService = static ::$webServiceUrl.'?method=check.user.token';
		$curl = new CurlModel ();
		$result = $curl->post ( $webService, $params );

		//解析json格式的返回值
		$result = json_decode ( $result );
		return $result;
	}

	/**
	 * auth.gettoken 获取用户认证信息
	 *
	 * @param
	 *        	array
	 * @return mixed
	 * @author fyq
	 */
	public static function getToken($params) {

		// auth_token认证
		$params = [
				'name' => $params ['name'],
				'password' => $params ['password'],
				'api_key' => static ::$api_key
		];
		$webService = static ::$webServiceUrl.'?method=auth.gettoken';
		$curl = new CurlModel ();
		$result = $curl->post ( $webService, $params );

		$result = json_decode ( $result );
		return $result;
	}

	/**
	 * Sendnotice. 发通知
	 *
	 * @param string $id
	 * @return mixed
	 */
	public static function sendNotice($to_uids,$title,$url) {

		for($i = 0; $i < count ( $to_uids ); $i ++) {

			$params ['uids[' . $i . ']'] = $to_uids [$i];
		}

		$params ['id'] = static ::$lappid; // 和轻应用有关
		$params ['eid'] = static ::$eid; // explode ( "@",$uid ) [1] ;// explode ( "@", $GLOBALS['uid'] ) [1]; // 企业id可在uid中解析到，@ 符后面数字为eid。
		$params ['title'] =$title;
// 		$params ['title'] = '有新的请假通知';

// 		$params ['url'] = 'http://' . $_SERVER ['HTTP_HOST'] . '/basic/web/index.php?r=pai-pictures/index&uid=&eguid=&auth_token=';
		$params ['url'] =$url;
// 		$params ['uids[0]'] = $to_uid; // 接收者uid (数组)
		$params ['auth_token'] = static ::$auth_token; // $GLOBALS['auth_token']
		$params ['api_key'] = static ::$api_key;
		$webService = static ::$webServiceUrl.'?method=lapp.notice';
		$curl = new CurlModel ();
		$result = $curl->post ( $webService, $params );

		$result = json_decode ( $result );
		return $result;

		// echo "<pre>";
		// echo "参数</br>";
		// var_dump ( $params );
		// echo "结果</br>";
		// var_dump ( $result );

		// 获取form post 参数
		// $uid = I ( 'uid' );
		// $uid = '3@3';

		// $params ['id'] = 5; // 轻应用id （企业门户添加轻应用后生成）
		// $params ['eid'] = explode ( "@", $uid ) [1]; // 企业id可在uid中解析到，@ 符后面数字为eid。
		// $params ['title'] = 'text' ; // 通知内容
		// $params ['url'] = "http://uc.sipsys.com"; // 通知的链接地址
		// $params ['uids[0]'] = $uid; // 接收者uid (数组)
		// $params ['auth_token'] = 'auth_token' ; // 用户认证
		// $params ['api_key'] = "36116967d1ab95321b89df8223929b14207b72b1";

		// // 接口地址
		// $webService = "http://192.168.139.162/elgg/services/api/rest/json/?method=lapp.notice";
		// $curl = new CurlModel ();
		// $result = json_decode ( $curl->post ( $webService, $params ), true );

		// $this->display ();

		// return $this->render ( 'view', [
		// 'model' => $this->findModel ( $id )
		// ] );
	}

	/**
	 * get.apps. 获取轻应用列表
	 *
	 * @param string $id
	 * @return mixed
	 */
	public static function getApps() {

		$params ['eguid'] = static ::$eguid; // 和轻应用有关
		$params ['uid'] = static ::$uid;

		$params ['auth_token'] = static ::$auth_token;
		$params ['api_key'] = static ::$api_key;
		$webService = 'http://192.168.139.160/appframe/web/index.php?r=webService/main/api&method=get.apps';
		$curl = new CurlModel ();
		$result = $curl->post ( $webService, $params );

		$result = json_decode ( $result );
		return $result;
	}


}