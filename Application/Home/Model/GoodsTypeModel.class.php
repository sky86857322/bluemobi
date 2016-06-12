<?php
namespace Home\Model;
use Think\Model\RelationModel;

class GoodsTypeModel extends RelationModel {
	public $trueTableName = 'g_type';
	protected $pk = 'code';
	protected $_link = array(
		'Goods'=> array(
				'mapping_type'  => self::HAS_MANY,
				'class_name'    => 'Goods',
				'foreign_key'   => 'type_code',
				'mapping_name'  => 'goods',
		),
	);
}