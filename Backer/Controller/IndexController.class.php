<?php
namespace Backer\Controller;
use Backer\Core\base;

class IndexController extends base {

	//直接继承 core\base，自由定义您的首页
	public function index(){
		$this->play('./index');
	}


}