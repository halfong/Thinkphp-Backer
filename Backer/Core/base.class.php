<?php
namespace Backer\Core;
use Think\Controller;

class base extends Controller {

	public $Assigns = array(
		'Backer'=>null,
		'C'=>null,
	);

	function __construct(){

		parent::__construct();
		if( !auth() ){ $this->error('没有权限！'); }

		$this->Assigns['C'] = array_merge(
			C('BACKER'),
			array('model'=>C('BACKER_MODELS')[strtolower(ACTION_NAME)])
		);
		$this->Assigns['Backer'] = C('BACKER_ACCOUNTS')[ session('backer')['name'] ];

		$this->fix_get_params();
	}

	
	private function fix_get_params(){
		foreach ($_GET as $k => $v) {
			if($v=='' || $v===null){ unset($_GET[$k]); }
		}
	}

	protected function play($tpl){
		$this->assign($this->Assigns);
		$this->display($tpl);
	}

	//带record参数跳转其它操作
	public function jump(){
		$record = I('get.record');
		$params = I('get.');
		exit(var_dump($params));
	}
}