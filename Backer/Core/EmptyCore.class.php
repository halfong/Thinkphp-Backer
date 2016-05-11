<?php
namespace Backer\Core;

class EmptyCore extends BaseCore{

	//将请求转给默认的Core控制器
	function _empty($action){
		$controller = CONTROLLER_NAME;
		try { A($controller,'Controller')->$action();  }
		catch(Execption $e){
			exit('[无法理解的访问]');
		}
	}

}