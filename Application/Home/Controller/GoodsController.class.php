<?php
namespace Home\Controller;
use Home\Facades\GoodsFacades;

class GoodsController extends BaseController {

	/**
	 * @action goods/lists
	 */
	public function lists(){
		$this->view("goods","lists");
	}

    /**
     * @action goods/search
     * @param
     *      curPage    	当前页
     *      sc   		搜索条件
	 * 			name	商品关键字
	 * 			type	类别
     */
    public function search(){
		//$_POST['curPage'] = 1;
		//$_POST['password'] = '123123';
		$curPage = $_POST['curPage'];
		$sc = [];
		$facades = new GoodsFacades();
		$result = $facades->search($sc,$curPage);
		$this->jsonEcho($result);
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