<?php
namespace Home\Facades;
use Home\Model\GoodsModel;
use Home\Model\GoodsTypeModel;

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

	/**
	 * 获取详情
	 * @param $id
	 *
	 * @return array
	 */
	public function getById($id){
		$result = [];
		$res = $this->model->getById($id);
		if(!empty($res)){
			$result = $res;
		}
		return $result;
	}

	/**
	 * @param $attribute
	 *
	 * @return array
	 */
	public function create($attribute){
		$goodsType = new GoodsTypeModel();
		$type = $goodsType->getById($attribute['type_id']);
		$attribute['type_code'] = $type['code'];
		$this->applyForCreate($attribute);
		return $this->model->createOne($attribute);
	}

	/**
	 * 获取所有商品类别
	 * @return array|mixed
	 */
	public function getAllType(){
		$model = new GoodsTypeModel();
		$result = $model->getAll();
		return $result;
	}
}