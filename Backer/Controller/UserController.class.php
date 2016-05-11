<?php
namespace Backer\Controller;
use Backer\Core\ModelCore;

class UserController extends ModelCore{


	protected $_model = 'Common/User';
	protected $_index = array(
		'table'=>array(
			'id'=>null,
			'mobile'=>null,
			'email'=>null,
			'acash'=>null,
			'vcash'=>null,
			'etime'=>"date,Y-m-d H:i:s,###",
			'ctime'=>"date,Y-m-d H:i:s,###",
		),
		'filter'=>array(
			'mobile'=>array('type'=>'input'),
		),
		'acts'=>array(
			'订单'=>'/Backer/Order/Index',
			'资金'=>'/Backer/Cash/Index',
			'编辑'=>'/Backer/User/Edit',
		),
	);
	protected $_edit = array(
		'form'=>array(
			'id'=>array('type'=>'hidden'),
			'mobile'=>array('type'=>'input',),
			'email'=>array('type'=>'input'),
			'password'=>array('type'=>'input'),
		),
	);

	protected function _before_play(){
		foreach ($this->_assigns['Records'] as &$record) {
			$record['acash'] = $record['cash']+$record['vcash'];
		}

	}

}