<?php
namespace Home\Facades;
use Home\Model\AdminModel;

class AdminFacades extends BaseFacades {
	public $model;
	public function __construct(){
		$this->model = new AdminModel();
	}

	/**
	 * 登录
     * @param $username
     * @param $password
	 * @return bool
     */
    public function login($username,$password){
		$password = md5($username.$password);
        return $this->model->login($username,$password);
    }

	/**
	 * 验证登录
	 */
	public static function checkLogin(){
		$admin = session('admin');
		if(empty($admin)){
			return false;
		}
		return $admin;
	}

	/**
	 * 退出
	 */
	public function logout(){
		session('admin',null);
	}

	/**
	 * 验证权限
	 * @param $right
	 */
	public static function checkUserRight($right){
		$admin = session('admin');
		$userRight = $admin['rights'];
		if(in_array('admin',$userRight)){
			return true;
		}
		if(in_array($right,$userRight)){
			return true;
		}
		return false;
	}

	/**
	 * 增加用户
	 * @param $username
	 * @param $password
	 * @return bool
	 */
	public function create($username,$password,$cPassword){
		if($password != $cPassword){
			return ['return'=>false,'message'=>'两次输入密码不一致'];
		}
		$password = md5($username.$password);
		return $this->model->createOne($username,$password);
	}
}