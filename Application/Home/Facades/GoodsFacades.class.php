<?php
namespace Home\Facades;
use Home\Model\GoodsModel;

class GoodsFacades extends BaseFacades {
	public $model;
	public function __construct(){
		$this->model = new GoodsModel();
	}

	/**
	 * 搜索
	 * @param array $sc
	 * @param int $curPage
	 * @param int $pageSize
	 * @param string $order
	 * @param string $sort
	 */
    public function search($sc = [],$curPage = 1,$pageSize = 20,$order = "",$sort = "desc"){
		list($curPage,$pageSize,$order) = $this->setPage($curPage,$pageSize,$order,$sort);
		list($itemCount,$res) = $this->model->search($sc,$curPage,$pageSize,$order);
		$pageParams = [
				'curPage'=>$curPage,
				'pageSize'=>$pageSize,
		];
		return $this->afterSearch($itemCount,$res,$pageParams);
    }


	public function createOne(){

		return $this->model->createOne();
	}
}