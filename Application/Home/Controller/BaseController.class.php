<?php
namespace Home\Controller;
use Think\Controller;
use Home\Facades\AdminFacades;

class BaseController extends Controller {
	public $checkAction = [];
	public function __construct()
	{
		parent::__construct();
		$u = U();
		$action = substr($u,strripos($u,"/") + 1,-5);
		if(in_array($action,$this->checkAction) && !AdminFacades::checkLogin()){
			$this->redirect("admin/login");
		}
	}

	/**
	 * 输出json
	 * @param $arr
	 */
	protected function jsonEcho($arr){
		echo json_encode($arr);
	}

	/**
	 * 输出视图
	 * @param $module
	 * @param $action
	 * @param array $params
	 */
	protected function render($module,$action,$params = []){
		$admin = session('admin');
		$arr = [
			'module'=>$module,
			'action'=>$action,
			'username'=>$admin['username'],
			'params'=>$params,
		];
		$this->assign($arr);
		$this->display("Public:header");
		$this->display();
		$this->display("Public:footer");
	}
}