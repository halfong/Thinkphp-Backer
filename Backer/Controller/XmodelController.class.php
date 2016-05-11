<?php
namespace Backer\Controller;
use Backer\Core\ModelCore;

class XmodelController extends ModelCore {

	/**
	* 定义Model
	* 例如 'Home/User'，将被用于 D('Home/User')
	**/
	protected $_model = 'Home/Xmodel';

	/**
	* 数据列表视图配置
	**/
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
	/**
	* 数据编辑视图配置
	**/
	protected $_edit = array(
		'form'=>array(
			'id'=>array('type'=>'hidden'),
			'title'=>array('type'=>'input'),
			'type'=>array('type'=>'radio','case'=>array(1,2,3,4,5,6,7)),
			'content'=>array('type'=>'richtext'),
		),
	);

	/**
	* ModelCore 提供以下方法：
	* _before_index: 在执行默认的index操作前调用
	* _before_edit:  在执行默认的edit操作前调用
	* _before_play:	在assign($this->_assigns)并display()前调用。通常用来特殊修改assign数据
	**/


}