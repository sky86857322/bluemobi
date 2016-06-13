<?php
namespace Home\Model;
use Think\Model\RelationModel;

class GoodsModel extends RelationModel {
	public $trueTableName = 'g_goods';

	protected $_link = array(
			'GoodsType'=>[
					'mapping_type'  => self::BELONGS_TO,
					'class_name'    => 'GoodsType',
					'foreign_key'   => 'type_id',
					'mapping_name'  => 'type',
					'mapping_fields'=>['name','info'],
			],
			'GoodsBrand'=>[
					'mapping_type'  => self::BELONGS_TO,
					'class_name'    => 'GoodsBrand',
					'foreign_key'   => 'brand_id',
					'mapping_name'  => 'brand',
					'mapping_fields'=>['name','info'],
			],
		);

	/**
	 * 搜索
	 * @param $sc
	 * @param $skip
	 * @param $pageSize
	 * @param $order
	 *
	 * @return array
	 */
    public function search($sc,$curPage,$pageSize,$order){
		$result = [];
		$itemCount = 0;
		$model = D("Goods");
		$res = $model->relation(true)->where($sc)->order($order)->page("{$curPage},{$pageSize}")->select();
		//var_dump($model);exit;
		if(!empty($res)){
			$itemCount = $model->where($sc)->count("id");
			foreach($res as $r){
				$r['is_up'] = !empty($r['is_up'])?"是":"否";
				$result[] = $r;
			}
		}
		return [$itemCount,$result];
    }

	/**
	 * 获取商品
	 * @param $id
	 *
	 * @return mixed
	 */
	public function getById($id){
		$model = D("Goods");
		return  $model->relation(true)->where(['id'=>$id])->find();
	}

	/**
	 * 创建
	 * @param $attribute
	 *
	 * @return int
	 */
	public function createOne($attribute){
		$model = D("Goods");
		$id = $model->add($attribute);
		return $id;
	}
}