<?php
namespace Home\Controller;
use Home\Facades\AdminFacades;

class AdminController extends BaseController {
	public $checkAction = ['create'];

    /**
     * @action admin/login
     * @param
     *      username    用户名
     *      password    密码
     */
    public function login(){
		if(!empty($_POST['username']) && !empty($_POST['password'])){
			$facades = new AdminFacades();
			$res = $facades->login($_POST['username'],$_POST['password']);
			if($res){
				$this->redirect('goods/lists');
			}
			else{
				$this->display();
			}
		}
		else{
			if(AdminFacades::checkLogin()){
				$this->redirect('goods/lists');
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
		$this->redirect('admin/login');
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
		$res = $facades->create($_POST['username'],$_POST['password'],$_POST['cPassword']);

	}
}