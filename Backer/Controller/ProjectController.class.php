<?php
namespace Backer\Controller;
use Backer\Core\ModelCore;

class ProjectController extends ModelCore{

	protected $_model = 'Common/Project';
	protected $_index = array(
		'table'=>array(
			'id'=>null,
			'name'=>null,
			'cate'=>"dict,###,cate",
			'rate'=>null,
			'amount'=>null,
			'sold'=>null,
			'start_time'=>"date,Y-m-d,###",
			'end_time'=>"date,Y-m-d,###",
			'active'=>"dict,###,active",
			'state'=>"dict,###,state",
		),
		'filter'=>array(
			'state'=>array('type'=>'tab','case'=>array(1,2,3)),
			'active'=>array('type'=>'tab','case'=>array(0,1)),
		),
		'acts'=>array(
			'上线/下线'=>'/Backer/Api/toggleActive',
		),
	);
	protected $_edit = array(
		'form'=>array(
			'id'=>array('type'=>'hidden'),
			'name'=>array('type'=>'input'),
			'cate'=>array('type'=>'radio','case'=>array(1,2,3)),
			'start_time'=>array('type'=>'date'),
			'end_time'=>array('type'=>'date'),
			'amount'=>array('type'=>'input'),
			'rate'=>array('type'=>'input'),
			'price'=>array('type'=>'input'),
			'order_amount_limit'=>array('type'=>'input'),
			'detail'=>array('type'=>'richtext'),
			//type: date , radio
		),
	);

}