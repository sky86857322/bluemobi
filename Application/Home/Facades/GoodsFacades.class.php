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
		$cArr = [];
		$con = "";
		list($curPage,$pageSize,$order) = $this->setPage($curPage,$pageSize,$order,$sort);
		if(!empty($sc['name'])){
			$cArr[] = "name like '%{$sc['name']}%'";
		}
		if(!empty($sc['type_id'])){
			$cArr[] = "type_id = '{$sc['type_id']}'";
		}
		if(!empty($cArr)){
			foreach($cArr as $c){
				$con .= $c." and ";
			}
			$con = substr($con,0,-4);
		}
		list($itemCount,$res) = $this->model->search($con,$curPage,$pageSize,$order);
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
	 * @param $id
	 * @param $attribute
	 *
	 */
	public function update($id,$attribute){
		$goodsType = new GoodsTypeModel();
		if(!empty($attribute['type_id'])){
			$type = $goodsType->getById($attribute['type_id']);
			$attribute['type_code'] = $type['code'];
		}
		$this->applyForUpdate($attribute);
		$this->model->updateById($id,$attribute);
	}

	/**
	 * @param $id
	 */
	public function delete($id){
		$this->model->deleteById($id);
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