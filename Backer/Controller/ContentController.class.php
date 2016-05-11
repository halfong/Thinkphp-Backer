<?php
namespace Backer\Controller;
use Backer\Core\ModelCore;

class ContentController extends ModelCore {

	protected $_model = 'Common/Content';
	protected $_index = array(
		'table'=>array(
			'id'=>null,
			'title'=>'magic_string,###',
			'type'=>"dict,###,type",
			'ctime'=>"date,Y-m-d H:i:s,###",
			'etime'=>"date,Y-m-d H:i:s,###",
			'active'=>"dict,###,active",
		),
		'filter'=>array(
			'type'=>array('type'=>'hidden','case'=>array(1,2,3,4,5,6,7)),
			'active'=>array('type'=>'tab','case'=>array(0,1)),
		),
		'acts'=>array(
			'编辑'=>'/Backer/Content/Edit',
			'上线/下线'=>'/Backer/Api/toggleActive',
		),
	);
	protected $_edit = array(
		'form'=>array(
			'id'=>array('type'=>'hidden'),
			'title'=>array('type'=>'input'),
			'type'=>array('type'=>'radio','case'=>array(1,2,3,4,5,6,7)),
			'content'=>array('type'=>'richtext'),
		),
	);

	public function _before_play(){
		//Banner显示表单处理
		if( ACTION_NAME=='Edit' && !I('get.save') && (I('get.type')==7 || $this->_assigns['Record']['type']==7)){
			$this->_assigns['Edit']['form']['title']['type']='file';
			$this->_assigns['Edit']['form']['content']['type']='input';
		}

	}

}