<?php
namespace Home\Controller;
use Think\Controller;
use Home\Facades\AdminFacades;

class BaseController extends Controller {
	public function __construct()
	{
		parent::__construct();
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