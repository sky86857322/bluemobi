<?php
namespace Home\Model;
use Think\Model\RelationModel;

class GoodsTypeModel extends RelationModel {
	public $trueTableName = 'g_type';

	public function getById($id){
		$model = D("GoodsType");
		$result = $model->where(['id'=>$id])->find();
		return $result;
	}

	public function getAll(){
		$model = D("GoodsType");
		$result = $model->select();
		return $result;
	}

}