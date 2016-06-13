<?php
namespace Home\Controller;
use Home\Facades\GoodsFacades;

class GoodsController extends BaseController {

	/**
	 * 列表
	 * @action goods/lists
	 */
	public function lists(){
		$this->render("goods","lists");
	}

	/**
	 * 详情
	 * @action goods/view/id/1	id为主键ID
	 */
	public function view($id){
		$facades = new GoodsFacades();
		$goodsType = $facades->getAllType();
		$this->render("goods","",['id'=>$id,'goodsType'=>$goodsType]);
	}

	public function add(){
		$facades = new GoodsFacades();
		$goodsType = $facades->getAllType();
		$this->render("goods","",['goodsType'=>$goodsType]);
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
	 * 详情
	 * @action goods/detail/id/1	id为主键ID
	 */
	public function detail($id){
		$facades = new GoodsFacades();
		$res = $facades->getById($id);
		$result = [
				'result'=>$res,
		];
		$this->jsonEcho($result);
	}

	/**
	 * @action admin/create
	 * @param
	 *      name    	商品名
	 *      type_id    	类别ID
	 */
	public function create(){
		if(empty($_POST['name']) || empty($_POST['type_id'])){
			$this->jsonEcho(['return'=>false,'message'=>'','extra'=>[]]);
			return;
		}
		$facades = new GoodsFacades();
		$id = $facades->create($_POST);
		$this->jsonEcho(['return'=>true,'message'=>'','extra'=>['id'=>$id]]);

	}
}