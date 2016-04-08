<?php
namespace Backer\Core;

class view extends base {

	function __construct(){
		parent::__construct();
		//获取数据
		$pageRecords = $this->pageRecords( D($this->Assigns['C']['model']['refer']) );

		$this->Assigns['Records'] = $pageRecords['records'];
		$this->Assigns['Pageindex'] = $pageRecords['pageindex'];
	}

	public function _empty($method,$args){
		$this->play('./list');
	}

	//分页获取数据
	private function pageRecords($M,$where=null,$order=null,$num=10){
		$where = $where ? $where :  I('get.');
		if(isset($where['order']))unset($where['order']);	//order为'排序'保留关键字
		$order = $order ? $order : ( I('get.order') ? I('get.order') : '-id' ) ;

		$count = $M->where($where)->count();
		$Page = new \Think\Page($count,$num);
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$pageindex	= $Page->show();

		$records = $M
			->where($where)
			->order($order)
			->limit($Page->firstRow.','.$Page->listRows)
			->select();
			//->getField('mobile,email,cash,vcash');
		return array('records'=>$records,'pageindex'=>$pageindex);
	}
	


}