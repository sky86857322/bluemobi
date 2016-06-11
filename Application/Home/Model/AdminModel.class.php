<?php
namespace Home\Model;
use Think\Model\RelationModel;

class AdminModel extends RelationModel {
	public $trueTableName = 'a_admin';

	protected $_link = array(
			'AdminRight'=>[
				'mapping_type'  => self::HAS_MANY,
				'class_name'    => 'AdminRight',
				'foreign_key'   => 'admin_id',
				'mapping_name'  => 'rights',
				'mapping_fields'=>['useright'],
			]
		);

	/**
	 * 管理员登录
	 * @param $username
	 * @param $password
	 *
	 * @return bool
	 */
    public function login($username,$password){
		$model = D("Admin");
		$res = $model->relation(true)->field(['id','username'])->where(['username'=>$username,'password'=>$password])->find();
		if(!empty($res)){
			if(!empty($res['rights'])){
				$rights = $res['rights'];
				unset($res['rights']);
				foreach($rights as $r){
					$res['rights'][] = $r['useright'];
				}
			}
			session('admin',$res);
			return true;
		}
		else{
			return false;
		}
    }

	/**
	 * 添加管理员
	 * @param $username
	 * @param $password
	 *
	 * @return bool
	 */
	public function createOne($username,$password){
		$model = D("Admin");
		$res = $model->field(['id','username'])->where(['username'=>$username])->find();
		if(!empty($res)){
			return ['return'=>false,'message'=>'已有重复用户'];
		}
		$model->username = $username;
		$model->password = $password;
		$model->add();
		return ['return'=>true,'message'=>''];
	}
}