<?php
namespace Home\Model;
use Think\Model\RelationModel;

class GoodsBrandModel extends RelationModel {
	public $trueTableName = 'g_brand';
	protected $_link = array(
		'Goods'=> array(
				'mapping_type'  => self::HAS_MANY,
				'class_name'    => 'Goods',
				'foreign_key'   => 'id',
				'mapping_name'  => 'goods',
		),
	);
}