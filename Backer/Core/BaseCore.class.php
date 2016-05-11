<?php
namespace Backer\Core;
use Think\Controller ;

class BaseCore extends Controller {

	protected $_assigns = array(
		'Config'=>null,
		'Backer'=>null,
	);


	function __construct(){
		parent::__construct();
		$this->_assigns['Config'] = C('BACKER');
		$this->_assigns['Backer'] = auth();
		$this->fix_get_params();
	}


	/**
	* Custom Assign Datas By Override this function in your Class.
	**/
	protected function _before_play(){

	}
	
	protected function play($tpl){
		$this->_before_play();
		$this->assign($this->_assigns);
		$this->display($tpl);
	}


	private function fix_get_params(){
		foreach ($_GET as $k => $v) {
			if($v=='' || $v===null){ unset($_GET[$k]); }
		}
	}

}