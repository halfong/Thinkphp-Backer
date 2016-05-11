<?php
namespace Backer\Controller;
use Backer\Core\ModelCore;

class OrderController extends ModelCore{

	protected $_model = 'Common/Order';
	protected $_index = array(
		'table'=>array(
			//使用filter方法过滤数据
			'id'=>"encodeID,###",
			'u_mobile'=>null,
			'p_name'=>null,
			'p_rate'=>null,
			'amount'=>null,
			'earnings'=>null,
			'p_end_time'=>"date,Y-m-d,###",
			'ctime'=>"date,Y-m-d H:i:s,###",
			'state'=>"dict,###,state",
		),
		'filter'=>array(
			//'u_mobile'=>array('type'=>'input'),
			'state'=>array('type'=>'tab','case'=>array(1,2,3)),
		),
	);

	protected function _before_index(){
		//来自User的查询转换数据
		if( isset($_GET['m']) ){
			if( isset($_GET['id']) && $_GET['m']=='User'){
				$_GET['u_id'] = $_GET['id'];
				unset($_GET['id']);
			}
			unset($_GET['m']);
		}
	}


	protected function _before_play(){
		//解决Order数据结构问题
		foreach ($this->_assigns['Records'] as &$record) {
			$record['u_mobile'] = $record['user']['mobile'];
			$record['p_rate'] = $record['project']['rate'];
			$record['p_name'] = $record['project']['name'];
			$record['p_end_time'] = $record['project']['end_time'];
		}
	}

}