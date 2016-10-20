<?php
namespace app\models;

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
 * @property static string $id 轻应用的唯一ID
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
	private static $id;
	private static $eguid;
	private static $webServiceUrl;
	private static $gid;
	private static $nid;


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

	public static function setId($id){
		static ::$id=$id;
	}
	public static function getId(){
		return static ::$id;
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
}