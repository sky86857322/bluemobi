<?php
namespace Home\Controller;
use Think\Controller;
use Home\Facades\AdminFacades;

class GoodsController extends Controller {
    /**
     * @action goods/search
     * @param
     *      sc    		搜索条件
     *      password    密码
     */
    public function search(){
		//$_POST['username'] = 'sky';
		//$_POST['password'] = '123123';
		$facades = new AdminFacades();
		if(!empty($_POST['username']) && !empty($_POST['password'])){
			$facades->login($_POST['username'],$_POST['password']);
		}
		else{
			if($facades->checkLogin()){

			}
			else{
				$this->display();
			}
		}
    }

	/**
	 * 退出
	 * @action admin/logout
	 */
	public function logout(){
		$facades = new AdminFacades();
		$facades->logout();
	}

	/**
	 * @action admin/create
	 * @param
	 *      username    用户名
	 *      password    密码
	 * 		cPassword    密码
	 */
	public function create(){
		$_POST['username'] = 'sky';
		$_POST['password'] = '123123';
		$_POST['cPassword'] = '123123';
		$facades = new AdminFacades();
		$res = $facades->createOne($_POST['username'],$_POST['password'],$_POST['cPassword']);

	}
}