<?php
namespace Home\Model;
use Think\Model\RelationModel;

class AdminRightModel extends RelationModel {
	public $trueTableName = 'a_right';
	protected $_link = array(
		'Admin'=> array(
				'mapping_type'  => self::BELONGS_TO,
				'class_name'    => 'AdminRight',
				'foreign_key'   => 'admin_id',
				'mapping_name'  => 'rights',
		),
	);
}